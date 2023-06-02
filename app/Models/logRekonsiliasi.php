<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logRekonsiliasi extends Model
{
    use HasFactory;

    protected $table        = "logrekonsiliasi";
    public $timestamps      = true;


    protected $fillable = [
        'name',
        'qty',
        'lastqty'
    ];
}
