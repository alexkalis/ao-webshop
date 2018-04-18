@extends('layouts.app')
  @section('content')
    <h3>Hallo</h3>
    @foreach ($products as $product)
        <h3> This is {{$product->name}}</h3>
    @endforeach
@endsection
