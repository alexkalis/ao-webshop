<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  /*
  *The category that belongs to the product
  */
  public function categories() {
    return $this->belongsToMany('App\Categories', 'product_categories','product_id','category_id');
  }

}
