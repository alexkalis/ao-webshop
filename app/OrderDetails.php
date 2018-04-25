<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{

      protected $fillable = [
          'order_id',
          'product_id',
          'quantity',
      ];
      public function product() {
        return $this->belongsTo('App\Products', 'product_id');
      }
}
