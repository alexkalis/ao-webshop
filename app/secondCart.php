<?php

namespace App;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetails;
use Auth;

class secondCart
{
    protected $items;
    public function __construct() {
        $this->items = session()->get('secondCart' );
        if (empty($this->items) ) {
            $this->items = [];
            // session()->put('secondCart', $this->items);
        }
    }
    /*
    *Gets the item
    */
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
        // $session = session()->get('secondCart');
        // dd($session);
    }

    public function removeItem($id) {
        foreach ($this->items as $storedItem) {
        if ($storedItem['id'] == $id){
            session()->forget('secondCart.'.$storedItem['id']);
          }
        }
    }

    public function removeSingleItem($id) {
        foreach ($this->items as $storedItem) {
        if ($storedItem['id'] == $id){
          $storedItem['qty']--;
          if($storedItem['qty'] == 0){
            session()->forget('secondCart.'.$storedItem['id']);
            return;
          }
          $this->items[$id] = $storedItem;
          session()->put('secondCart', $this->items);
        }
      }
    }
    public function getItems() {
        if ($this->items == null) {
            return null;
        } else {
        foreach ($this->items as $item) {
            $product = Products::find($item['id']);
            $items[] = $product;
        }
        return array($items, $this->items);
    }
}
    public function getTotalCartDetails() {
        if ($this->items == null) {
            return null;
        } else {
            foreach($this->items as $item) {
                $product = Products::find($item['id']);
                $quantity[] = $item['qty'];
                $price[] = $item['qty'] * $product->price;
            }
            $totalQty = array_sum($quantity);
            $totalPrice = array_sum($price);
            return array($totalQty, $totalPrice);
        }
    }


}
