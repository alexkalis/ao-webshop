@extends('layouts.app')
  @section('content')
    @foreach ($products as $product)
        <h3> Product: {{$product->name}}</h3>
        <br>
    @endforeach
@endsection
