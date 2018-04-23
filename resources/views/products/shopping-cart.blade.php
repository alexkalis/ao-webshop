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
                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Action <span class="caret"></span> </button>
                 <ul class="dropdown-menu">
                   <li><a href="{{route('product.reduceByOne', ['id' =>$product['item']['id']])}}">reduce by 1</a></li>
                   <li><a href="{{route('product.remove', ['id' =>$product['item']['id']])}}">reduce all</a></li>
                   <li><a href="{{route('product.add', ['id' =>$product['item']['id']])}}">add by one</a></li>
                 </ul>
              </div>
            </li>
          @endforeach
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
      <strong>totale prijs: € {{$totalPrice}}</strong>
      <strong>totale producten: {{$totalQty}}</strong>
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
      <h2>Geen producten in de winkel wagen</h2>
  </div>
  </div>
@endif
@endsection
