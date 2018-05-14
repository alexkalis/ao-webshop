<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{


/*
*makes it so that only these properties can be added to the database
*
*
*
*/
      protected $fillable = [
          'order_id',
          'product_id',
          'quantity',
      ];

      /*
      *this links the OrderDetails table with the products table using the belongsto function where you give the foreign key of the Orderdetails.
      *
      *
      */
      public function product() {
        return $this->belongsTo('App\Products', 'product_id');
      }
}
