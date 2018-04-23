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
     *$prds gets the product tabel via the products model
     * then returns the data with the $prds to the view with the index
     */
    public function index()
    {
      $prds = Products::orderBy('created_at', 'desc')->paginate(10);
    return view('products.index')->with('prds', $prds);
    }
    public function show($id) {
      $products = \App\Products::find($id);
      // $cat_prd = Categories::all()->load('product');
      return view('products.show', ['products' => $products]);
    }

    /*
    *get the cart from the cart model
    *$product finds the id that is given with the index link
    *$oldCart checks if there already is a cart that exists and if there is'nt it makes a new one
    * if a cart does exist it uses that oldcart and it puts the new items into that new Cart
    *$cart makes a new cart withthe oldcart variable from the line before that(goes throught the $oldcart again)
    *the $cart->add puts the new id(product,price) into the cart.
    *$request->session puts the the cart into the session.
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

    /*
    *This function removes one product
    *checks if session has cart
    *makes a new cart
    *removes one and that function is gotten from the cart model
    *the if checks if there are any other items in the cart if not then it will forget the session and show: there are no items or whatever you text you have put into the shopping cart file.
    *then it reloads the shopping cart with the item(s) removed.
    */
    public function reduceByOne($id) {
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->reduceByOne($id);
      if ( count($cart->items) > 0) {
          Session::put('cart', $cart);
      } else {
        Session::forget('cart');
      }

      return redirect()->route('product.shoppingCart');
    }


    /*
    *This function removes an whole product even if there are a large amount of them
    *checks if sessio has cart
    *makes a new cart
    *removes all the items and that function is gotten from the cart model.
    *the if checks if there are any other items in the cart if not then it will forget the session and show: there are no items or whatever you text you have put into the shopping cart file.
    *then it reloads the shopping cart with the items removed.
    */
    public function removeItem($id) {
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->removeItem($id);

      if ( count($cart->items) > 0) {
          Session::put('cart', $cart);
      } else {
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');
    }
/*
*This function does the same as the one above with one differenceL
*With this you can add a item in the shopping cart itself and not with the add to cart button
*
*/
    public function addItem(Request $request,$id) {
      $product = Products::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);
      $request->session()->put('cart',$cart);
      return redirect()->route('product.shoppingCart');
    }
    /*
    *this functions gets the cart
    *als the session geen cart heeft stuur naar de lege shopping-cart
    *then it gets the cart from the session
    *then it makes a new cart with $cart
    *then it returns the shopping cart to the view with the products(cart->items is the $cart from this function and the items is from the cart model, same go's for the totalprice)
    *
    */
      public function getCart() {
      if (!Session::has('cart')) {
        return view('products.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      return view('products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
    }
    /*
    *get the cart from the session
    *the $cart gets the cart from $oldcart
    *$order gets the relationship onetomany from the Order model.
    *then it makes it so the cart is changed into something that can be put into the database
    *then it saves the cart with the user into the database.
    */
    public function toDatabase() {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $order = new Order();
      $order->cart = serialize($cart);

      Auth::user()->orders()->save($order);
      Session::forget('cart');
      return view('user.profile');

    }
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
