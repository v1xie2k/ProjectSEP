<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Htrans extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $connection   = "konek_buku";
    protected $table        = "htrans";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_user',
        'id_ekspedisi',
        'quantity',
        'total',
    ];
    public function Users(){
        return $this->belongsTo(Users::class, 'id_user','id');
    }
    public function Ekspedisis(){
        return $this->belongsTo(Ekspedisi::class, 'id_ekspedisi','id');
    }
    public function Dtrans(){
        return $this->hasMany(Dtrans::class, 'id','id_htrans');
    }
}
