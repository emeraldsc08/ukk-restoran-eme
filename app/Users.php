<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    // nama tabel
    protected $table = 'users';
    // kolom-kolom yang bisa diisi banyak row sekaligus dalam 1 waktu
    protected $fillable = ['username', 'password', 'id_level', 'nama'];
    
    // nilai constant
    const ADMIN = 1;
    const WAITER = 2;
    const KASIR = 3;
    const OWNER = 4;
}
