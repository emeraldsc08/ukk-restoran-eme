<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['id_pelanggan', 'id_user'];

    public function detail_pesanan()
    {
       return $this->hasMany('App\DetailPesanan', 'id_pesanan', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Users', 'id', 'id_user');
    }

    public function meja()
    {
        return $this->hasOne('App\Meja', 'id', 'id_meja');
    }
}
