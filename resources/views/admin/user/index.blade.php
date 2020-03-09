@extends('layouts.admin')

@section('title', 'Manage user')
@section('content')
	<div class="card">
	  <div class="card-header">
	    <h3 class="card-title">List User</h3>

	    <div class="card-tools">
	      <div class="input-group input-group-sm">
	        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

	        <div class="input-group-append">
	          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
	        </div>
	      </div>
	    </div>
	  </div>
	  <!-- /.card-header -->
	  <div class="card-body table-responsive p-0">
	    <table class="table table-hover text-nowrap">
	      <thead>
	        <tr>
	          <th>Email</th>
	          <th>Name</th>
	          <th>Role</th>
	          <th>Option</th>
	        </tr>
	      </thead>
	      <tbody>
	        @foreach($users as $key => $user)
	        	<tr>
	        		<td><a href ='{{ url("/user/$user->id") }}' >{{ $user->email }}</a></td>
	        		<td>{{ $user->name }}</td>
	        		<td>
	        			<select class="form-control set_role" data="{{ $user->id }}">
	        				@foreach($role as $r)
	        					@php
	        						$selected = ($r['id'] === $user->role) ? 'selected="selected"' : "";
	        					@endphp
	        					<option value="{{ $r['id'] }}" class="form-control" {{ $selected }}>{{ $r["name"] }}</option>
	        				@endforeach
	        			</select>
	        		</td>
	        		<td>
	        			<form action='{{ url("/user/$user->id") }}' method="POST">
	        				@method("DELETE")
	        				@csrf	
	        				<button type="submit" class="btn btn-default btn-sm">
	        					<i class="fa fa-trash" aria-hidden="true"></i>
	        				</button>
	        			</form>
	        			</form>
	        		</td>
	        	</tr>
	        @endforeach
	      </tbody>
	    </table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->
@endsection
@section('js_page')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="{{ asset('js/user.js') }}"></script>
@endsection
