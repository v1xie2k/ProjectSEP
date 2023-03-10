<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ekspedisi extends Model
{
    use HasFactory;

    // protected $connection   = "konek_buku";
    protected $table        = "ekspedisi";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'name',
        'ongkir'
    ];
}
