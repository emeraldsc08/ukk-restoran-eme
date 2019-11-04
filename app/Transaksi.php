<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // nama tabel
    protected $table = 'transaksi';
    // kolom-kolom yang bisa diisi lebih dari banyak row sekaligus dalam 1 waktu
    protected $fillable = ['id_user', 'bayar'];

    // relasi
    public function pesanan()
    {
        return $this->hasOne('App\Pesanan', 'id', 'id_pesanan');
    }
}
