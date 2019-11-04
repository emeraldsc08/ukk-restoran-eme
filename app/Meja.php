<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja';
    protected $fillable = ['nomer'];

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'id_meja', 'id');
    }
}
