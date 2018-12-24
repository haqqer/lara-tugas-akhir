<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = [
        'user_id','judul','deskripsi'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
