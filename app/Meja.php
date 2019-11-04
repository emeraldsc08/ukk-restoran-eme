<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    // nama tabel
    protected $table = 'meja';
    // kolom-kolom yang bisa diisi lebih dari banyak row sekaligus dalam 1 waktu
    protected $fillable = ['nomer'];

    // relasi
    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'id_meja', 'id');
    }
}
