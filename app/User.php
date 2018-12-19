<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function berita() {
        return $this->hasMany('App\Berita', 'user_id');
    }

    public function kegiatan() {
        return $this->hasMany('App\Kegiatan', 'user_id');
    }

    public function publikasi() {
        return $this->hasMany('App\Publikasi', 'user_id');
    }
    
    public function materi() {
        return $this->hasMany('App\materi', 'user_id');
    }
}
