@extends('layouts.app')

@section('content')

	<div class="row post-page form-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Edit Post</h1>
				</div>
				<div class="">
					<a href="/posts/" class="btn btn-secondary">Go Back</a>
				</div>
			</div>
			
			{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
			@if($post->image_name)
				<div class="edit-photo"><img src="/storage/uploaded_images/{{$post->image_name}}" class="img-fluid img-thumbnail"></div>
				{{Form::hidden('post_image', 'true')}}
			@endif
				<div class="form-group">
					{{Form::textarea('content', $post->content, ['class' => 'form-control', 'id' => 'summary-ckeditor', 'rows' => 3])}}
				</div>
				{{Form::hidden('_method','PUT')}}
				{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
			{!! Form::close() !!}

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection