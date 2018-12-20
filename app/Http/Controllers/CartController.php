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
        // dd($cartItems);
        if ($cartItems[0] == null) {
            $totalPrice = null;
            $totalQty = null;
            $allItems = null;
            $quantity = null;
        } else {
        $totalPrice = $cartItems[1][0];
        $totalQty = $cartItems[2];
        $allItems = $cartItems[1][1];
        $quantity = $cartItems[0];
    }
        return view('products.cart')->with(['items' => $allItems, 'totalQty' => $totalQty, 'totalPrice' => $totalPrice, 'quantity' => $quantity]);
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
    public function getPrice() {
        $cart = new Secondcart();
        $cart->getTotalPrice();
    }
}
