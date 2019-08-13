@extends('layouts.app')

@section('content')

	<div class="row user-page">
		<div class="col-12">

			<div class="d-flex flex-row align-items-center">
				<div class="mr-auto">
					<h1>All Users</h1>
				</div>
				<div class="">
					<a href="/users/create" class="btn btn-primary">Create A New User</a>
				</div>
			</div>
			<ul class="list-group card-user-list mt-2">
				{{-- Table Header --}}
{{-- 				<li class="list-group-item">
					<div class="card-user-list-item d-flex justify-content-between">
						<a href="" class="row clickable-row flex-fill">
							<div class="col-md-3 col-sm-6 col-12">Name</div>
							<div class="col-md-3 col-sm-6 col-12">Team</div>
							<div class="col-md-4 col-sm-10 col-12">Email</div>
							<div class="col-md-1 col-sm-2 col-12">Admin</div>
							<div class="col-md-1 col-sm-2 col-12"></div>
						</a>
					</div>
				</li> --}}
				{{-- User List --}}
				@if(count($users)>0)
					@foreach($users as $user)
						<li class="list-group-item">
							<div class="card-user-list-item clickable-row">
								<a href="/users/{{$user->id}}/edit" class="row">
									<div class="col-md-3 col-sm-6 col-12">{{$user->name}}</div>
									<div class="col-md-3 col-sm-6 col-12">{{$user->team_name}}</div>
									<div class="col-md-4 col-sm-10 col-12">{{$user->email}}</div>
									<div class="col-md-1 col-sm-2 col-12">
										@if($user->is_admin)
											<i class="fas fa-check-square"></i>
										@else
											<i class="far fa-square"></i>
										@endif
									</div>
								</a>
								<div class="trash-item">
				                    <a class="delete-anchor" href="#" data-value="delete-form{{ $user->id }}">
				                        <i class="fas fa-trash"></i>
				                    </a>
									{!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'user', 'class' => 'delete-hidden', 'id' => 'delete-form'.$user->id])!!}
				                        @csrf
										{{Form::hidden('_method', 'DELETE')}}
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

@endsection