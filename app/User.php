<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    protected $primaryKey = "email";
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function donations() { //donations user ever give
        return $this->hasMany("App\Donation", "usermail", "email");
    }

    public function campaigns() { //campaigns user ever create
        return $this->hasMany("App\Campaign", "usermail", "email");
    }

    public function comments() { //comments user ever make
        return $this->hasMany("App\Comment", "usermail", "email");
    }
}
