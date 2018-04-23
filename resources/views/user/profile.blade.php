@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <p>User profile</p>
    <hr>
    <h2>My orders</h2>

    {{--
    --this $orders it gets from the user controller and in it is the cart unserialized
    --
    --
    --}}
    @foreach($orders as $order)
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="list-group">
            @foreach($order->cart->items as $item)
              <li class="list-group-item">
                <span class="badge">{{$item['price']}} €</span>
                {{$item['item']['title']}} | {{$item['qty']}} Units
              </li>
              @endforeach
          </ul>
        </div>
        <div class="panel-footer">
        <strong>Total Price:{{$order->cart->totalPrice}}</strong>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
