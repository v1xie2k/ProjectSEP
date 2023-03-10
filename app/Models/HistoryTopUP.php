<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryTopUP extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $connection   = "konek_buku";
    protected $table        = "history_topup";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;


    protected $fillable = [
        'id_user',
        'topup',
        'status',
        'alasan'
    ];
    public function Users(){
        return $this->belongsTo(Users::class, 'id_user','id');
    }
}
