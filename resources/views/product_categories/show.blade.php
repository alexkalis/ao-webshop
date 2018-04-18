@extends('layouts.app')
  @section('content')

    @foreach ($cat_prd as $cat)
      <h3>{{$cat->name}}</h3>
    @endforeach
@endsection
