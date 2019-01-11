@extends('layouts.app')
  @section('content')
      @if (Session::has('error'))
          {{Session::Get('error')}}
      @endif
      <a href="/products" class=" btn-default ">Go Back</a>
      <h3>{{$product->name}}</h3>
      <h3>{{$product->description}}</h3>
      <h3>€{{$product->price}}</h3>
      <br><br>
      <a href="{{ route('product.addToCart', ['id' =>$product->id]) }}" class="btn btn-success pull-right" role="button">Add to cart</a>
  <hr>
  </hr>
  <hr>
  {{-- @if (Auth::user())

     @if ($review)
         <div class=" navbar-expand-md navbar-light navbar-laravel panel panel-default">
             @foreach ($review as $key)
                 <p class=""> Review: {{$key->review}} </p>
                 <p>Van {{$key->name}}</p>
                 <p>Wanneer: {{$key->created_at}}</p>
             @endforeach
        </div>
     @else
  <div class="panel panel-default">
      <form class="" action="{{Action('ReviewController@createReview')}}" method="post">
          @csrf
          <div class="form-group">
              <label class="col-md-3 control-label" for="name">Naam:</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Your name" class="form-control" value="{{Auth::user()->name}}">
              </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Email:</label>
                <div class="col-md-9">
                  <input id="name" name="email" type="text" placeholder="Your name" class="form-control" value="{{Auth::user()->email}}">
                </div>
              </div>
              <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="review" placeholder="Please enter your feedback here..." rows="5"></textarea>
              </div>
            </div>
            <input type="text" hidden="true" name="product" value="{{$product->id}}">
            {{csrf_field()}}
              <button type="submit" class="btn btn-primary btn-md">Voeg review toe</button>
              <button type="reset" class="btn btn-default btn-md">Leegmaken</button>
      </form>
  </div>
@endif --}}
{{-- @endif --}}

@endsection
