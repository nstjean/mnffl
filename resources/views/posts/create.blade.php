@extends('layouts.app')

@section('content')

	<div class="row post-page form-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Create New Post</h1>
				</div>
				<div class="">
					<a href="/posts/" class="btn btn-secondary">Go Back</a>
				</div>
			</div>

			{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				<div class="form-group">
					{{Form::textarea('content', '', ['class' => 'form-control', 'id' => 'summary-ckeditor', 'rows' => 3])}}
				</div>
				<div class="form-group">
					{{Form::file('post_image')}}
				</div>
				{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
			{!! Form::close() !!}

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection