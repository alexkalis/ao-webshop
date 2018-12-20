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
        $totalPrice = $cart->getTotalPrice();
        // dd($totalPrice);
        if ($cartItems == null) {
            $allItems = null;
            $totalQty = null;
        } else {
            foreach ($cartItems as $item) {
                $allItems[] = Products::find($item['id']);
                $quantity[] = $item['qty'];
            // dd($allItems);
        }
            $totalQty = array_sum($quantity);
            // dd($totalQty);
    }

        return view('products.cart')->with(['items' => $allItems, 'quantity' => $cartItems, 'totalQty' => $totalQty, 'totalPrice' => $totalPrice]);
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
