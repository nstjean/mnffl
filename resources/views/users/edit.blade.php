@extends('layouts.app')

@section('content')

	@empty($user)
		{{! $user = Auth::user() }}
	@endempty

	<div class="row post-page form-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Edit User Info</h1>
				</div>
				<div class="">
					<a href="{{ url('/users/') }}" class="btn btn-secondary">Go Back</a>
				</div>
			</div>
			
			{!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				<div class="form-group">
					{{Form::label('email', 'Email:', ['class' => ''])}}
					{{Form::text('email', $user->email, ['class' => 'form-control', 'disabled' => 'disabled'])}}
				</div>
				<div class="form-group">
					{{Form::label('name', 'Name:', ['class' => ''])}}
					{{Form::text('name', $user->name, ['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::label('team_name', 'Team Name:', ['class' => ''])}}
					{{Form::text('team_name', $user->team_name, ['class' => 'form-control'])}}
				</div>
				[profile pic]
				<div class="form-group">
					{{Form::label('is_admin', 'Is Administrator:', ['class' => ''])}}
					{{Form::checkbox('is_admin', $user->is_admin, ['class' => 'form-control'])}}
				</div>
				
				{{Form::hidden('_method','PUT')}}
				{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
			{!! Form::close() !!}

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection