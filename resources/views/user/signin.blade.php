@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <h1>Sign in</h1>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
      @endforeach
    </div>
    @endif
    <form action="{{ route('user.signin') }}" method="post">
        @csrf
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">password</label>
        <input type="password" id="password" name="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="name">name</label>
        <input type="text" id="name" name="name" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
      {{ csrf_field() }}
    </form>
    <p>Don't have an account? <a href="{{route('user.signup')}}">Registreer er dan een.</a></p>
  </div>
</div>
@endsection
