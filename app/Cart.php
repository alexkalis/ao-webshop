<?php

namespace App;

use Illuminate\Http\Request;
use App\Products;
use Auth;
use Session;
class Cart
{

  /*
  *make variable
  *if this class is called the the construct wil check if there already is a cart if so add new items to old cart if not add items to new Cart
  *add a new item with the qty price and the item itself into the stored item variable.
  *then at the end the stored item gets put into the original items variable up top.
  */
    public $items;
    public $totalQty;
    public $totalPrice;

    public function __construct($oldCart = []) {
      if ($oldCart) {
        $this->items = $oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;
      }
    }
    /*
    *this function is called add and this function is used in the products controller.
    *you make a new variable called storeditem and in that you put in the qunatity from the storeditems , then you get the price from the item and you get the item itself.
    *if the variable id and this->items exist then you need to store that into the $storedItem variable
    *
    */
    public function add($item, $id) {
      $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
      if($this->items){
        if (array_key_exists($id, $this->items)) {
          $storedItem = $this->items[$id];
        }
      }
      /*
      *the first one adds 1 and stores it into the array object qty
      *the second one calculates the price and stores it into the array object price
      *then the storeditem gets put into the public $items up above.
      *the totalQty gets plus numbers from the storeditem.
      *the += adds the item->price to the totalprice.
      */

      $storedItem['qty']++;
      $storedItem['price'] = $item->price * $storedItem['qty'];
      $this->items[$id] = $storedItem;
      $this->totalQty++;
      $this->totalPrice += $item->price;
    }
    /*
    *this removes one item in the current item group.
    *it also takes of the price of that item.
    *then it gets taken off the list of all items and of the total price varaible
    *the last thing checks if the value is smaller than 0 then it gets deleted
    */
    public function reduceByOne($id) {
      $this->items[$id]['qty']--;
      $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
      $this->totalQty--;
      $this->totalPrice-= $this->items[$id]['item']['price'];

      if($this->items[$id]['qty'] <= 0) {
        unset($this->items[$id]);
      }

    }
    /*
    *this removes all items in the current item group.
    *it also takes of the price of those items.
    *then it gets taken off the list of all items and of the total price variable
    *then it the group gets deleted.
    */
    public function removeItem($id) {
      $this->totalQty -= $this->items[$id]['qty'];
      $this->totalPrice-= $this->items[$id]['price'];
      unset($this->items[$id]);
    }

    public function addItemModel(Request $request, $id) {
        $product = Products::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);

        $request->session()->put('cart',$cart);
    }
    public function getCartModel() {
        if (!Session::has('cart')) {
          return view('products.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return $cart;
    }
    public function reduceItemModel($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if ( count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
          Session::forget('cart');
        }
    }
    public function removeItemModel($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if ( count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
          Session::forget('cart');
        }
    }
    public function toDatabaseModel() {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $items = $cart->items;
        $order = Order::create([
          'user_id' => Auth::user()->id,
        ]);
        // $order->cart = serialize($cart);
        foreach ($items as $item) {
          OrderDetails::create([
            'order_id' => $order->id,
            'product_id' => $item['item']->id,
            'quantity' =>$item['qty'],
          ]);
        }
        Session::forget('cart');
    }

}
