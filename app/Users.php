<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    // nama tabel
    protected $table = 'users';
    // kolom-kolom yang bisa diisi lebih dari banyak row sekaligus dalam 1 waktu
    protected $fillable = ['username', 'password', 'id_level', 'nama'];
}
