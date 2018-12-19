<?php

namespace App;

use Illuminate\Http\Request;


class secondCart
{
    protected $items;
    public function __construct() {
        $this->items = session()->get('secondCart' );
        if (empty($this->items) ) {
            $this->items = [];
        }
    }

    public function add($id)
    {
        $product = Products::find($id);
        if (isset($this->items[$id])) {
            $storedItem = $this->items[$id];
        } else {
            $storedItem = ['qty' => 0, 'id' => $product->id];
          }
        $storedItem['qty']++;
        $this->items[$id] = $storedItem;
        session()->put('secondCart', $this->items);
    }
    public function removeItem() {
        echo "Hallo iedereen";
    }
    public function removeSingleItem() {
        echo "Hallo mensen";
    }
    public function getItems() {
        $items = session()->get('secondCart');
        return $items;
    }

    public function cartToDatabase() {
        echo "Hallo volk";
    }
}
