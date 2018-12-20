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

    public function removeItem() {
        echo "Hallo iedereen";
    }
    public function removeSingleItem() {
        echo "Hallo mensen";
    }
    public function getItems() {
        $items[] = $this->items;
        $items[] = $this->getTotalPrice();
        $items[] = $this->getTotalQuantity();
        return $items;

    }
    public function getTotalPrice() {
        if ($this->items == null) {
            return;
        } else {
        foreach ($this->items as $item) {
            $product = Products::find($item['id']);
            $totalItems[] = $product;
            $price[] = $item['qty'] * $product->price;
        }
        $totalPrice = array_sum($price);
        return array($totalPrice, $totalItems);
    }
    }
    public function getTotalQuantity() {
        if ($this->items == null) {
            return;
        } else {
            foreach($this->items as $item) {
                $quantity[] = $item['qty'];
            }
            $totalQty = array_sum($quantity);
            return $totalQty;
        }
    }

    public function cartToDatabase() {
        echo "Hallo volk";
    }
}
