@extends('layouts.app')

@section('content')

	<div class="row user-page">
		<div class="col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>All Users</h1>
				</div>
				<div class="">
					<a href="/users/create" class="btn btn-primary">Create A New User</a>
				</div>
			</div>
			<ul class="list-group card-user-list">
				@if(count($users)>0)
					@foreach($users as $user)
						<li class="list-group-item">
							<div class="card-user-list-item row">
								<div class="col-md-3 col-sm-6 col-12">{{$user->name}}</div>
								<div class="col-md-3 col-sm-6 col-12">{{$user->team_name}}</div>
								<div class="col-md-3 col-sm-12 col-12">{{$user->email}}</div>
								<div class="col-md-1 col-sm-2 col-12">{{$user->is_admin}}</div>
								<div class="col-md-1 col-sm-6 col-12"><a href="/users/{{$user->id}}/edit" class="btn btn-sm btn-primary">Edit</a></div>
								<div class="col-md-1 col-sm-6 col-12">
									{!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'user', 'class' => 'delete-form'])!!}
										{{Form::hidden('_method', 'DELETE')}}
										{{Form::submit('Delete', ['class' => 'btn btn-sm btn-danger'])}}
									{!!Form::close()!!}
								</div>
							</div>
						</li>
					@endforeach
				@else
					<p>No users found</p>
				@endif
			</ul>

		</div>
	</div>

	<script>
	    $(".delete").on("submit", function(){
	        return confirm("Permanently delete this user?");
	    });
	</script>

@endsection