<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/*
*this connects the user table to the order table with a one to many relationship
*
*/
class Order extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }
}
