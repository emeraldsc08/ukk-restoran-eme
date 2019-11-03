<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $fillable = ['id_pesanan','id_menu', 'jumlah'];

    public function menu()
    {
        return $this->hasOne('App\Menu', 'id', 'id_menu');
    }
}
