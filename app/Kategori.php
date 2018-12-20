<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama','jml'
    ];

    public function berita() {
        return $this->hasMany('App\Berita', 'kategori_id');
    }
}
