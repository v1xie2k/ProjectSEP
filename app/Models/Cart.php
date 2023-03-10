<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;

    protected $table        = "cart";
    // protected $primaryKey   = "buku_id";
    // public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_user',
        'id_menu',
        'name_menu',
        'price',
        'quantity',
        'subtotal',
    ];

    public function Users(){
        return $this->belongsTo(Users::class, 'id_user','id');
    }
    public function Menus(){
        return $this->hasMany(Menu::class, 'id','id_menu');
    }
}
