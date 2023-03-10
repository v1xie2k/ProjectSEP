<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    // protected $connection   = "mysql";
    protected $table        = "users";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = true;

    // protected $appends = ['nama_umum','name', 'role'];

    // public function getRoleAttribute()
    // {
    //     return $this->pengguna_role;
    // }

    // public function getNameAttribute()
    // {
    //     return $this->pengguna_nama;
    // }

    // public function getNamaUmumAttribute()
    // {
    //     return $this->pengguna_nama;
    // }

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'saldo',
        'role',
    ];

    // kesalahan #5
    // pastikan kita override, function getAuthPassword
    // karena secara default dia mencari kolom namanya password
    // tapi di database tidak ada kolom namanya password maka
    // ketika cek login itu bentuknya
    // pengguna_email : mimi@gmail.com
    // password nya   : NULL!!!!
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function Carts(){
        return $this->hasOne(Cart::class, 'id','id_user');
    }
    public function Histories(){
        return $this->hasMany(HistoryTopUP::class, 'id','id_user');
    }
    public function Htrans(){
        return $this->hasMany(Htrans::class, 'id','id_user');
    }
    public function Refunds(){
        return $this->hasMany(Refund::class, 'id','id_user');
    }

}
