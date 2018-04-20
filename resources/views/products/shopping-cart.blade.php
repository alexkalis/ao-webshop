<!--
this is the cart view.
it gets it's $variables from the ProductsController.
it shows what's in your shoppingCart.
-->

@extends('layouts.app')
@section('content')
  @if(Session::has('cart'))
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
      <ul class="list-group">
          @foreach ($products as $product )
            <li class="list-group-item">
              <span class="badge">{{$product['qty']}}</span>
              <strong>{{$product['item'] ['name']}}</strong>
              <span class="label label-success">{{$product['price']}}</span>
              <div class="btn-group">
                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" name="button" data-toggle="dropdown">Action <span class="caret"> </span> </button>
                 <ul class="dropdown-menu">
                   <li><a href="">reduce by 1</li>
                     <li><a href="">reduce all</li>
                 </ul>
              </div
            </li>
          @endforeach
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
      <strong>Total: {{$totalPrice}}</strong>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
<a href="{{route('product.added')}}">   <button type="button" class="btn btn-success" name="button">Order</button></a>
</div>
</div>
@else
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
      <h2>no items in cart</h2>
  </div>
  </div>
@endif
@endsection
