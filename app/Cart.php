<?php

namespace App;


class Cart
{

  /*
  *make varaibles
  *if this class is called the the construct wil check if there already is a cat if so add new items to old cart if not add items to new Cart
  *add a new item with the qty price and the item itself into the stored item variable.
  *then at the end the stored item gets put into the original items variable up top.
  */
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
      if ($oldCart) {
        $this->items = $oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;
      }
    }
    public function add($item, $id) {
      $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
      if($this->items){
        if (array_key_exists($id, $this->items)) {
          $storedItem = $this->items[$id];
        }
      }
      $storedItem['qty']++;
      $storedItem['price'] = $item->price * $storedItem['qty'];
      $this->items[$id] = $storedItem;
      $this->totalQty++;
      $this->totalPrice += $item->price;
    }
}
