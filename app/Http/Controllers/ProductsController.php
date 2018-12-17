<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use App\Products;
use App\Review;

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
        $products = Products::orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', ['prds' => $products]);
    }
    /*
    *This shows a single product.
    */
    public function show($id)
    {
        $product = Products::find($id);
        $user = Auth::user();
        $review = Review::where(['product_id' => $id ])->get();
        if (!$review->first()) {
            $review = null;
        }
      return view('products.show', ['product' => $product, 'review' => $review]);
    }

    /*
    *Adds an item to the cart using the additemmodel function.
    */
    public function addToCart(Request $request, $id)
    {
        $cart = new Cart;
        $cart->addItemModel($request,$id);
        return redirect()->back();
      // dd($request->session()->get('cart'));
    }

    /*
    *This function removes one product using the reduceItemModel function.
    */
    public function reduceByOne($id)
     {
          $cart = new Cart;
          $cart->reduceItemModel($id);
          return redirect()->route('product.shoppingCart');
    }


    /*
    *This function removes every qty of a single product using the remove item model.
    */
    public function removeItem($id)
    {
          $cart = new Cart;
          $cart->removeItemModel($id);
          return redirect()->route('product.shoppingCart');
    }
    /*
    *this functions gets the cart using the getcartmodel function.
    */
     public function getCart()
      {
         $cart = new Cart;
         $cartInventory = $cart->getCartModel();
         return view('products.shopping-cart', ['products' => $cartInventory->items, 'totalPrice' => $cartInventory->totalPrice, 'totalQty' => $cartInventory->totalQty]);
    }
    /*
    *Push the cart to the database using the toDatabaseModel function.
    */
    public function toDatabase()
    {
     $cart = new Cart;
     $cart->toDatabaseModel();
      return redirect('profile');
    }
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
