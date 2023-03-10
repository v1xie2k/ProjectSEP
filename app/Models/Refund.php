<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{
    use HasFactory;

    // protected $connection   = "konek_buku";
    protected $table        = "refund";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_user',
        'subtotal',
        'name_admin',
    ];
    public function Users(){
        return $this->belongsTo(Users::class, 'id_user','id');
    }

}
