@extends('layouts.app')
  @section('content')
    {{-- <h2>{{$categories->name}}</h2> --}}
    @if (count($products) >0)
      @foreach ($products as $product)
          <h3> Product: {{$product->name}}</h3>
          <br>
      @endforeach
    @else
      <h2>Er zijn geen producten beschikbaar.</h2>
    @endif
    <a href="{{ url()->previous() }}">Ga terug</a>
@endsection
