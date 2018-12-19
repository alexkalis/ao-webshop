@extends('layouts.app')
@section('content')
    @if (session()->has('secondCart'))

        <h2>Dit is de inhoud van het winkelwagentje:</h2>
        @foreach ($items as $item )
            @foreach ($item as $key)
                <ul class="list-group">
                  <li class="list-group-item" style="margin-right:1000px">
                    <strong>{{$key['name']}}</strong>
                    <span class="label label-success">{{$key['price']}}</span>
                    @foreach ($quantity as $qty)
                        @if ($key['id'] == $qty['id'])
                            <span class="label label-success">{{$qty['qty']}}</span>
                        @endif
                    @endforeach
                    <div class="btn-group">
                      <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Action <span class="caret"></span> </button>
                       <ul class="dropdown-menu">
                         <li><a href="{{route('product.reduceByOne', ['id' =>$key['item']['id']])}}">reduce by 1</a></li>
                         <li><a href="{{route('product.remove', ['id' =>$key['item']['id']])}}">reduce all</a></li>
                         <li><a href="{{route('product.addToCart', ['id' =>$key['item']['id']])}}">add by one</a></li>
                       </ul>
                    </div>
                  </li>
              </ul>

            @endforeach
        @endforeach
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
          <strong>totale prijs: € </strong>
          <strong>totale producten: {{$totalQty}}</strong>
      </div>
    @else
        <h2>Er zit niks in het winkelwagentje</h2>
    @endif

@endsection
