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
        $total = $cart->getTotalCartDetails();
        return view('products.cart')->with(['cartItems' => $cartItems, 'total' => $total]);
    }

    public function removeItem($id) {
        $cart = new Secondcart();
        $cart->removeItem($id);
        return redirect()->back();
    }
    public function reduceByOne($id) {
        $cart = new Secondcart();
        $cart->removeSingleItem($id);
        return redirect()->back();
    }
    public function cartToDatabase() {
        $cart = new Secondcart();
        $cart->cartToDatabase();
        return redirect()->back();
    }
}
