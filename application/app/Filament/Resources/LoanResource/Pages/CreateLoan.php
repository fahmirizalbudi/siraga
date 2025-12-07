<?php

namespace App\Filament\Resources\LoanResource\Pages;

use App\Filament\Resources\LoanResource;
use App\Models\Item;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLoan extends CreateRecord
{
    protected static string $resource = LoanResource::class;

    public function afterCreate(): void
    {
        $item = Item::find($this->record->item_id);

        if ($item && $item->stock > 0) {
            $item->decrement('stock');
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
