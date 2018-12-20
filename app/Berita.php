<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    
    protected $fillable = [
        'user_id','judul','deskripsi','foto','kategori_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function kategori() {
        return $this->belongsTo('App\Kategori');
    }
}
