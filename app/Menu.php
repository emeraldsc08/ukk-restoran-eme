<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['nama', 'harga'];

    public function jenisMenu()
    {
        return $this->hasOne('App\JenisMenu', 'id', 'id_jenis_menu');
    }
}
