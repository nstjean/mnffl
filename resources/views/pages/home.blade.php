@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <div><img src="{{ url('/storage/images/') }}/mnffl.png" alt="MNFFL Title Image"></div>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Log In</a>
    </div>

@endsection