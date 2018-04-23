@extends('layouts.app')
  @section('content')
      <a href="/products" class=" btn-default ">Go Back</a>
      <h3>{{$products->name}}</h3>
      <h3>{{$products->description}}</h3>
      <h3>€{{$products->price}}</h3>
      <br><br>
      <a href="{{ route('product.addToCart', ['id' =>$products->id]) }}" class="btn btn-success pull-right" role="button">Add to cart</a>
  <hr>
  </hr>
  <hr>
@endsection
