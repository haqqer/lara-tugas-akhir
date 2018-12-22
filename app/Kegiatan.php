<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    
    protected $fillable = [
        'user_id','judul','deskripsi','tempat','waktu'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
