<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMenu extends Model
{
    // nama tabel
    protected $table = 'jenis_menu';
    // kolom-kolom yang bisa diisi lebih dari banyak row sekaligus dalam 1 waktu
    protected $fillable = ['nama'];
}
