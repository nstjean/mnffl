@extends('layouts.app')

@section('content')

    <div class="row form-page">
        <div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-12">

            <div class="d-flex flex-row align-items-center">
                <div class="mr-auto">
                    <h1>Create A New User</h1>
                </div>
                <div class="">
                    <a href="/users/" class="btn btn-primary">Back</a>
                </div>
            </div>

            <div class="card">

                <div class="card-body">
                    {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @csrf

                        <div class="form-group row">
                            {{Form::label('new_name', 'Name:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::text('new_name', '', ['class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('new_email', 'Email:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::text('new_email', '', ['class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('team_name', 'Team Name:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::text('team_name', '', ['class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('password', 'Password:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::password('password', ['class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                            <div class="col-md-6">
                                {{Form::password('password_confirmation', ['class' => 'form-control'])}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>
        <div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
    </div>

@endsection