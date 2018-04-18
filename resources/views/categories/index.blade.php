@extends('layouts.app')
@section('content')
    <h1>Categories</h1>
    @if(count($categories) > 0)
      @foreach($categories as $category)
        <div class="well">
              <h3><a href="/categories/{{$category->id}}">{{$category->id}} {{$category->name}}<a/></h3>
          </div>
      @endforeach
    @else
          <p>No posts found</p>
        @endif
    @endsection
