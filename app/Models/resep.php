<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class resep extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table        = "resep";
    public $timestamps      = true;


    protected $fillable = [
        'id_menu',
    ];

    public function Resep(){
        return $this->hasMany(detail_resep::class, 'id','id_resep');
    }
}
