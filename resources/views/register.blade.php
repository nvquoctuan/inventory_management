@extends('layouts.customer')
@section('title', 'Register')
@section('content')
<h2>Register</h2>
@include('shared.alert', ['errors' => $errors])

<!-- form start -->
<form role="form" id="quickForm" action="/register" method="POST">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="text" name="name" class="form-control" placeholder="Your name">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password_confirmation" class="form-control" id="exampleInputPasswordConfirmation" placeholder="Password">
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
</form>
@endsection