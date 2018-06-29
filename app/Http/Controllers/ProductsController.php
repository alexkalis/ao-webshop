<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use App\Order;
use App\OrderDetails;
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
      return view('products.index', ['prds' => $prds]);
    }
    /*
    *This gets the id(product) from the url and then gives this to the show view which shows the details of the product.
    *In $products all the data(from products) is gotten from the table(products) with the correct id that is gotten from the url.
    *then it gives the $products to the view(products.show) using an array: ['products' => $products].
    *
    *
    *
    */
    public function show($id) {
      $products = Products::find($id);
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
    *The ? and : on the 2nd line of the function is an if else statement.
    *on line 4 it makes a new cart with the oldcart inside, if there is no oldcart it will make a brandnew cart.
    */
    public function addToCart(Request $request, $id) {
      $test = new Cart;
      $test->addItemModel($request,$id);
      return redirect()->route('products.index');
      // dd($request->session()->get('cart'));
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
      $test = new Cart;
      $test->reduceItemModel($id);
      return redirect()->route('product.shoppingCart');
    }


    /*
    *This function removes an whole product even if there are a large amount of them
    *checks if session has cart
    *makes a new cart
    *removes all the items and that function is gotten from the cart model.
    *the if checks if there are any other items in the cart if not then it will forget the session and show: there are no items or whatever you text you have put into the shopping cart file.
    *then it reloads the shopping cart with the items removed.
    */
    public function removeItem($id) {
      $test = new Cart;
      $test->removeItemModel($id);
      return redirect()->route('product.shoppingCart');
    }
/*
*This function does the same as the one above with one differenceL
*With this you can add a item in the shopping cart itself and not with the add to cart button
*
*/
    public function addItem(Request $request,$id) {
      $test = new Cart;
        $test->addItemModel($request,$id);
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
          $test = new Cart;
          $cart = $test->getCartModel();
          return view('products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
    }
    /*
    *get the cart from the session
    *the $cart gets the cart from $oldcart
    *$order gets the relationship onetomany from the Order model.
    *$order makes it so that when a user is logged in you can put something to the database.
    *then it foreaches the items from the cart and those items get put into the OrderDetails table wth the order id, item id and the quantity.
    *then it saves the cart with the user into the database to the OrderDetails table
    *then the session forgets the cart
    *And goes back to the user.profile.
    */


    public function toDatabase() {
     $test = new Cart;
     $test->toDatabaseModel();
      return redirect('profile');
    }
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
