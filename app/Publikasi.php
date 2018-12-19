<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $table = 'publikasi';

    protected $fillable = [
        'user_id','nama','deskripsi'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
