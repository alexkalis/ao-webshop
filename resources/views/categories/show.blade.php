@extends('layouts.app')
  @section('content')
    {{-- <h2>{{$categories->name}}</h2> --}}
    @if (count($products) >0)
      @foreach ($products as $product)
                <h3>{{$product->name}}</h3>
                <h3>{{$product->description}}</h3>
                <h3>€{{$product->price}}</h3>
                <a href="{{ route('product.addToCart', ['id' =>$product->id]) }}" class="btn btn-success pull-right" role="button">Add to cart</a>
            <hr>
      @endforeach

    @else
      <h2>Er zijn geen producten beschikbaar.</h2>
    @endif
    <a href="{{ url()->previous() }}">Ga terug</a>
  </hr>
  <hr>
@endsection
