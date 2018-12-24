<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftardl extends Model
{
    protected $table = 'daftardl';
    protected $fillable = [
        'user_id','nama','deskripsi','file'
    ];
    public function user()
    {
        return $this->belongsTo('App/User');
    }
}
