<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const TRANSACTION_TYPE_IN = 'IN';
    const TRANSACTION_TYPE_OUT = 'OUT';

    protected $fillable = [
        'transaction_date',
        'product_id',
        'quantity',
        'transaction_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
