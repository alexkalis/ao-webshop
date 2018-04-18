<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Products;
class Categories extends Model
{
  /*
  *The product that belongs to the category
  */
  public function product() {
      return $this->belongsToMany('App\Products');
  }
}
