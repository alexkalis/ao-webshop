@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <p>User profile</p>
    <hr>
    <h2>My orders</h2>

    {{--
    --this $orderDetails it gets from the user controller and from there it gets send to here.
    --
    --
    --}}

    @if (isset($orderDetails) )


      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="list-group">
            {{--
            --$detail->product() is de product function/method in the orderDetails model.
            --$detail->product goes from user controller gets it from order model and that gets it from orderdetails model
            --}}
        @foreach ($orderDetails as $detail)
                <hr>
                <h2>Dit is van bestelling: {{$detail->order_id}}</h2>
                <br>
                <h2>Bestelde product:{{$detail->product()->first()->name}}</h2>
                <h2>Zo vaak is het besteld: {{$detail->quantity}}</h2>
                <br>
                <h2> en dit was de price per product: {{$detail->product()->first()->price}}</h2>
                {{-- <h2>{{$detail->quantity * $detail->product()->first()->price}}</h2> --}}
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
