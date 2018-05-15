<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  /*
  *makes it so than when a user is logged in then you can put something to the database if not then it doesn't allow it.
  */
  protected $fillable = [
      'user_id',
  ];

  /*
  *this connects the user table to the order table with a one to many relationship
  *
  */
    public function user() {
      return $this->belongsTo('App\User');
    }
    /*
    *this connects the OrderDetails table to the order table with a has many relationship
    *one order can have multiple details.
    */
    public function details() {
      return $this->hasMany('App\OrderDetails', 'order_id');
    }
}
