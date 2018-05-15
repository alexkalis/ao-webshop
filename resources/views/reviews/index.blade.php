@extends('layouts.app')
@section('content')
    <h1>Review</h1>
  @foreach ($reviews as $review )
    <h3>De beoordeling: {{$review->review}}</h3>
    {{-- <h3>De gebruiker: {{$review->user_id}}</h3>
    <h3>Het product: {{$review->product_id}}</h3> --}}

    <br>
  @endforeach
@endsection
