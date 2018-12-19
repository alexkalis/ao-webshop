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
        } else{
        foreach ($cartItems as $item) {
            $allItems[] = Products::where(['id'=> $item['id']])->get();
            $quantity[] = $item['qty'];
            foreach ($allItems as $itemsQty) {
                // dd($itemsQty);
                    $price[] = $item['qty'] * $itemsQty[0]['price'];
                }
        } }
        // dd($price);
        $totalPrice = array_sum($price);
        // dd($totalPrice);
        $totalQty = array_sum($quantity);
        // dd($totalQty);

        return view('products.cart')->with(['items' => $allItems, 'quantity' => $cartItems,'totalQty' => $totalQty]);
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
