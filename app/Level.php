<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    // nama tabel
    protected $table = 'level';
    // kolom-kolom yang bisa diisi banyak row sekaligus dalam 1 waktu
    protected $fillable = ['level'];
}
