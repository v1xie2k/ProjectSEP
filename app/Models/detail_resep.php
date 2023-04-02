<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detail_resep extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table        = "detail_resep";
    public $timestamps      = true;


    protected $fillable = [
        'id_resep',
        'id_barang',
        'qty',
    ];

    public function Resep(){
        return $this->belongsTo(resep::class, 'id_resep','id');
    }
    public function Barang(){
        return $this->belongsTo(barang::class, 'id_barang','id');
    }
}
