@extends('layouts.app')
@section('content')
    {{-- @if (session()->has('secondCart')) --}}
    @if ($cartItems[0])
        {{-- {{dd($cartItems)}} --}}
        <h2>Dit is de inhoud van het winkelwagentje:</h2>
        @foreach ($cartItems[0] as $item )
                <ul class="list-group">
                  <li class="list-group-item" style="margin-right:800px">
                    <strong>{{$item['name']}}</strong>
                    @foreach ($cartItems[1] as $qty)
                        @if ($item['id'] == $qty['id'])
                            @php
                            $productPrice = $item['price'] * $qty['qty'];
                            @endphp
                            <span class="label label-success">Prijs: {{$productPrice}}</span>
                            <span class="label label-success">Aantal: {{$qty['qty']}}</span>
                            {{-- {{dd($item['id'])}} --}}
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actie <span class="caret"></span> </button>
                                <ul class="dropdown-menu">
                                  <li><a href="{{route('product.reduceByOne', ['id' =>$item['id']])}}">Verwijder 1</a></li>
                                  <li><a href="{{route('product.remove', ['id' =>$item['id']])}}">Verwijder product</a></li>
                                  <li><a href="{{route('product.addToCart', ['id' =>$item['id']])}}">Voeg 1 toe</a></li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                        {{-- <input name="qty" value="{{$qty['qty']}}"></input> --}}
                  </li>
              </ul>
            @endforeach
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
          <strong>totale prijs: € {{$total[1]}}</strong>
          <strong>totale producten: {{$total[0]}}</strong>
      </div>
      <a href="{{route('product.post')}}">   <button type="button" class="btn btn-success" name="button">Bestel</button></a>

    @else
        <h2>Er zit niks in het winkelwagentje</h2>
    @endif

@endsection
