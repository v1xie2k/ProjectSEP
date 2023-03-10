<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $connection   = "konek_buku";
    protected $table        = "menu";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_kategori',
        'name',
        'harga',
        'deskripsi',
    ];

    public function Kategories(){
        return $this->belongsTo(KategoriMenu::class, 'id_kategori','id');
    }
    public function Carts(){
        return $this->hasMany(Cart::class, 'id','id_menu');
    }
    public function Dtrans(){
        return $this->hasMany(Dtrans::class, 'id','id_menu');
    }
}
