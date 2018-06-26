@extends('layouts.app')
@section('content')
    <h1>Artikelen</h1>
    @if(count($prds) > 0)
      @foreach($prds as $prd)
        <div class="well">
          <div>
              <h3><a href="/products/{{$prd->id}}">{{$prd->name}}<a/></h3>
              <h3>€{{$prd->price}}</h3>
              <a href="{{ route('product.addToCart', ['id' =>$prd->id]) }}" class="btn btn-success pull-right" role="button">Add to cart</a>
            </div>
          </div>
        </div>
      @endforeach
        @else
          <p>No products found.</p>
      @endif
    @endsection
