<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\secondCart;
use Auth;
use App\Products;
use App\Review;

class CartController extends Controller
{
    public function add($id){
        $cart = new Secondcart();
        $cart->add($id);
        return redirect()->back();
    }
    public function getCart(){
        $cart = new Secondcart();
        $cartItems = $cart->getItems();
        if ($cartItems == null) {
            $allItems = null;
            $totalQty = null;
        } else {
            foreach ($cartItems as $item) {
                $allItems[] = Products::find($item['id']);
                $quantity[] = $item['qty'];
                foreach ($allItems as $items) {
                        $price[] = $item['qty'] * $items[0]['price'];
                    }
            }
            // dd($allItems);
            $totalPrice = array_sum($price);
            $totalQty = array_sum($quantity);
            // dd($totalQty);
    }

        return view('products.cart')->with(['items' => $allItems, 'quantity' => $cartItems, 'totalQty' => $totalQty]);
    }
    public function removeItem() {
        $cart = new Secondcart();
        $cart->removeItem();
    }
    public function removeSingleItem() {
        $cart = new Secondcart();
        $cart->removeSingleItem();
    }
    public function cartToDatabase() {
        $cart = new Secondcart();
        $cart->cartToDatabase();
    }
}
