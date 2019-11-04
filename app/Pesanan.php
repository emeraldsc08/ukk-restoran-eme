<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    // nama tabel
    protected $table = 'pesanan';
    // kolom-kolom yang bisa diisi lebih dari banyak row sekaligus dalam 1 waktu
    protected $fillable = ['id_pelanggan', 'id_user'];

    // relasi
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
