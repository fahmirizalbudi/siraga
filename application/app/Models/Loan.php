<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $guarded = ['id'];

    public function borrower() {
        return $this->belongsTo(Borrower::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
