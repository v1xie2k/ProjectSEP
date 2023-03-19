<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTransaksi extends Model
{
    use HasFactory;

    protected $table        = "logtrans";
    public $timestamps      = false;

    protected $fillable = [
        'id',
        'status_code',
        'transaction_id',
        'order_id',
        'gross_amount',
        'payment_type',
        'transaction_time',
        'pdf_url',
        'bank',
    ];
}
