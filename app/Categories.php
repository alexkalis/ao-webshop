<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Products;
class Categories extends Model
{
  /*
  *The product that belongs to the category
  */
  public function products() {
      return $this->belongsToMany('App\Products', 'product_categories', 'category_id','product_id');
  }
}
