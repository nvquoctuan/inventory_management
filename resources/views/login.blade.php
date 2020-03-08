@extends('layouts.customer')
@section('title', 'Login')
@section('content')
<h2 style="text-align: center">Login</h2>
@if(session('message'))
  <div class="alert alert-{{ @session('type') }}">
    {{ session('message') }}
  </div>
@endif
<!-- form start -->
<form action="/login" role="form" id="quickForm" method="POST">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      @if($errors->has('email'))
        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      @if($errors->has('password'))
        <span id="exampleInputPassword1-error" class="error invalid-feedback">{{ $errors->first('password') }}</span>
      @endif
    </div>
    <div class="form-group mb-0">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
       <label class="form-check-label" for="exampleCheck1">Remember me</label>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Login</button>
    <a href ="{{ route('register') }}">Register</a>
  </div>
</form>
@endsection