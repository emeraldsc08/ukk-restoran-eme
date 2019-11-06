<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    // nama tabel
    protected $table = 'detail_pesanan';
    // kolom-kolom yang bisa diisi banyak row sekaligus dalam 1 waktu
    protected $fillable = ['id_pesanan','id_menu', 'jumlah'];

    // nilai constant
    const DIBUAT = 'Dibuat';
    const DIPESAN = 'Dipesan';
    const DIANTAR = 'Sudah diantar';

    // relasi
    public function menu()
    {
        return $this->hasOne('App\Menu', 'id', 'id_menu');
    }
}
