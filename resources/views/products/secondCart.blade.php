@extends('layouts.app')
@section('content')
        <h2>Hallo</h2>
        {{-- @foreach ($session as $key )
            {{($key)}}
        @endforeach --}}
        {{-- <h2>Het product: {{$session['item']['name']}}</h2>
        <h2>Prijs van het product: {{$session['item']['price']}}</h2>
        <h2>Aantal van het product: {{$session['qty']}}</h2> --}}
        @foreach ($session as $key)
            {{$key}}
        @endforeach
        {{-- <h2>Totale kwantiteit: {{$totalQty}}</h2> --}}

        {{-- {{$session}} --}}
@endsection
