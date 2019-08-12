@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>{{ __('Change Password') }}</h1>

            <div class="card p-5 mt-3">

                {!! Form::open(['action' => ['ChangePasswordController@update'], 'method' => 'POST']) !!}
                    @csrf

                    <div class="form-group row">
                        {{Form::label('old-password', 'Old Password:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::password('old-password', ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('new-password', 'New Password:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::password('new-password', ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('password-confirm', 'Confirm New Password:', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::password('password-confirm', ['class' => 'form-control'])}}
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
</div>
@endsection
