<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
    /*
    *the orders function makes a relationship with the order table.
    this says that a user can have multiple orders but an order can not have multiple users.
    *òne user can have many orders. 

    */
    public function orders() {
      return $this->hasMany('App\Order');
    }
}
