<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction_detail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}