@extends('layouts.app')
@section('content')
    {{-- @if (session()->has('secondCart')) --}}
    @if ($items)
        <h2>Dit is de inhoud van het winkelwagentje:</h2>
        @foreach ($items as $item )
                <ul class="list-group">
                  <li class="list-group-item" style="margin-right:1000px">
                    <strong>{{$item['name']}}</strong>
                    @foreach ($quantity as $qty)
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
          <strong>totale prijs: € {{$totalPrice}}</strong>
          <strong>totale producten: {{$totalQty}}</strong>
      </div>
    @else
        <h2>Er zit niks in het winkelwagentje</h2>
    @endif

@endsection
