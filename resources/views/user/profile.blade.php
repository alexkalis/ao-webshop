@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <p>User profile</p>
    <hr>
    <h2>My orders</h2>

    {{--
    --this $orders it gets from the user controller and in it is the cart unserialized
    --
    --
    --}}

    @if (isset($orderDetails) )


      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="list-group">
        @foreach ($orderDetails as $detail)
                <hr>
                <h2>Dit is van bestelling: {{$detail->order_id}}</h2>
                <br>
                <h2>Bestelde product:{{$detail->product()->first()->name}}</h2>
                <h2>Zo vaak is het besteld: {{$detail->quantity}}</h2>
                <br>
                <h2> en dit was de price: {{$detail->product()->first()->price}}</h2>
        @endforeach
          </ul>
        </div>
        <div class="panel-footer">

        </div>
      </div>

  @else
    <h2>De orders zijn leeg</h2>
      @endif
  </div>
</div>
@endsection
