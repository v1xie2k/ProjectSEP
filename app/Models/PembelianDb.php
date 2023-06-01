<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembelianDb extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $connection   = "konek_buku";
    protected $table        = "pembelian";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_barang',
        'qty',
        'harga',
        'supplier'
    ];

}
