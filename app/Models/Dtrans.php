<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dtrans extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $connection   = "konek_buku";
    protected $table        = "dtrans";
    // protected $primaryKey   = "buku_id";
    // public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_htrans',
        'id_menu',
        'name_menu',
        'price',
        'quantity',
        'subtotal',
    ];

    public function Htrans(){
        return $this->belongsTo(Htrans::class, 'id_htrans','id');
    }
    public function Menus(){
        return $this->belongsTo(Menu::class, 'id_menu','id');
    }
}
