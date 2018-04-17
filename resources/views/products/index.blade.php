@extends('layouts.app')
@section('content')
    <h1>Artikelen</h1>
    @if(count($products) > 0)
      @foreach($products as $product)
        <div class="well">
          <div>
              <h3><a href="/products/{{$product->id}}">{{$product->name}}<a/></h3>
            </div>
          </div>
        </div>
      @endforeach
        @else
          <p>No posts found</p>
      @endif
    @endsection
