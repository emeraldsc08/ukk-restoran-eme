<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // nama tabel
    protected $table = 'menu';
    // kolom-kolom yang bisa diisi lebih dari banyak row sekaligus dalam 1 waktu
    protected $fillable = ['nama', 'harga'];

    // relasi
    public function jenisMenu()
    {
        return $this->hasOne('App\JenisMenu', 'id', 'id_jenis_menu');
    }
}
