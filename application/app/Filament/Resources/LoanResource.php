<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Item;
use App\Models\Loan;
use Carbon\Carbon;
use DB;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transactions';

    public static function getCleanOptionString(Model $model): string
    {
        return view('components.select-item-default')
            ->with('name', $model?->name)
            ->with('image', $model?->image)
            ->render();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('borrower_id')
                    ->label('Borrower')
                    ->relationship('borrower', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                Select::make('item_id')
                    ->label('Item')
                    ->allowHtml()
                    ->searchable()
                    ->preload()
                    ->getSearchResultsUsing(function (string $search) {
                        $item = Item::where('name', 'like', "%{$search}%")->limit(50)->get();

                        return $item->mapWithKeys(function ($item) {
                            return [$item->getKey() => static::getCleanOptionString($item)];
                        })->toArray();
                    })
                    ->getOptionLabelUsing(function ($value): string {
                        $item = Item::find($value);

                        return static::getCleanOptionString($item);
                    })->columnSpanFull(),

                Hidden::make('loan_date')
                    ->default(today()->toDateString()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('item.image')
                    ->label('Image')
                    ->height(50)
                    ->width(50),

                TextColumn::make('borrower.name')
                    ->label('Borrower'),

                TextColumn::make('loan_date')
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)
                            ->locale('id')
                            ->translatedFormat('d F Y');
                    }),

                TextColumn::make('return_date')
                    ->label('Return Date')
                    ->getStateUsing(function ($record) {
                        if ($record->return_date) {
                            return Carbon::parse($record->return_date)
                                ->locale('id')
                                ->translatedFormat('d F Y');
                        } else {
                            return '<p style="color:#71717a">Not Returned</p>';
                        }
                    })
                    ->html()
            ])
            ->filters([])
            ->actions([
                DeleteAction::make(),
                Action::make('mark_as_returned')
                    ->label('Mark as Returned')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->return_date = today()->toDateString();
                        $record->save();

                        if ($record->item) {
                            $record->item->increment('stock');
                        }
                    })
                    ->visible(fn($record) => $record->return_date === null),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
        ];
    }
}
