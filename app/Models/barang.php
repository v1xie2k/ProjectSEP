<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table        = "barang";
    public $timestamps      = true;


    protected $fillable = [
        'name',
        'stok',
    ];

    public function Barang(){
        return $this->hasMany(detail_resep::class, 'id','id_barang');
    }

}
