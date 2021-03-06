@extends('layouts.app')

@section('content')

	<div class="row form-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-center">
				<div class="mr-auto">
					<h1>Edit User Info</h1>
				</div>
				<div class="">
					<a href="{{ url('/users/') }}" class="btn btn-primary">Go Back</a>
				</div>
			</div>
			
            <div class="card">

    			{!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @csrf

                    <div class="form-group row">
                        {{Form::label('name', 'Name:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('email', 'Email:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::text('email', $user->email, ['class' => 'form-control', 'disabled' => 'disabled'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('team_name', 'Team Name:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::text('team_name', $user->team_name, ['class' => 'form-control'])}}
                        </div>
                    </div>

                    @if(Auth::user()->isAdmin())
        				<div class="form-group row">
                            {{Form::label('is_admin', 'Is Administrator:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6 checkbox-container">
            					{{Form::checkbox('is_admin', '1', $user->is_admin ? true : false, ['class' => 'regular-checkbox'])}}
                                <label for="is_admin"></label>
        					</div>
        				</div>
                    @endif

                    <div class="form-group row">
                        {{Form::label('profile_pic', 'Current Profile:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            @if($user->profile_pic)
                                <div class="profile-pic-wrapper">
                                    <img src="{{ url('/storage/profile_pics/'.$user->profile_pic) }}" class="profile-pic">
                                </div>
                            @endif
                        </div>
                    </div>
    				
                    <div class="form-group row">
                        {{Form::label('profile_pic', 'Upload Profile Pic:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::file('profile_pic')}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
    						{{Form::hidden('_method','PUT')}}
                            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                        </div>
                    </div>
    			{!! Form::close() !!}

            </div>

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection