@extends('layouts.app')
@section('content')
    {{-- @if (session()->has('secondCart')) --}}
    @if ($cartItems[1][1])
        <h2>Dit is de inhoud van het winkelwagentje:</h2>
        @foreach ($cartItems[1][1] as $item )
                <ul class="list-group">
                  <li class="list-group-item" style="margin-right:1000px">
                    <strong>{{$item['name']}}</strong>
                    @foreach ($cartItems[0] as $qty)
                        @if ($item['id'] == $qty['id'])
                            @php
                            $productPrice = $item['price'] * $qty['qty'];
                            @endphp
                            <span class="label label-success">Prijs: {{$productPrice}}</span>
                            <span class="label label-success">Aantal: {{$qty['qty']}}</span>
                        @endif
                    @endforeach

                        {{-- <input name="qty" value="{{$qty['qty']}}"></input> --}}
                  </li>
              </ul>
            @endforeach
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
          <strong>totale prijs: € {{$cartItems[1][0]}}</strong>
          <strong>totale producten: {{$cartItems[2]}}</strong>
      </div>
    @else
        <h2>Er zit niks in het winkelwagentje</h2>
    @endif

@endsection
