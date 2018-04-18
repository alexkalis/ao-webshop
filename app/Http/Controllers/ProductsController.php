<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use App\Order;
use App\Products;
use App\Categories;
use Session;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $prds = Products::orderBy('created_at', 'desc')->paginate(10);
    return view('products.index')->with('prds', $prds);
    }
    /*
    *get the cart from the cart model
    *
    *
    */
    public function getAddToCart(Request $request, $id) {
      $product = Products::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product,$product->id);

      $request->session()->put('cart',$cart);
      // dd($request->session()->get('cart'));
      return redirect()->route('products.index');
    }
    public function getCart() {
      if (!Session::has('cart')) {
        return view('products.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      return view('products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);

    }
    public function toDatabase() {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $order = new Order();
      $order->cart = serialize($cart);

      Auth::user()->orders()->save($order);
    }
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
