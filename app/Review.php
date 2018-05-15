<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $table = 'reviews';

    public function product() {
      return $this->belongsTo('App\Products', 'product_id');
    }
}
