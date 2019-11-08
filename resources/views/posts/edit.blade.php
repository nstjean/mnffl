@extends('layouts.app')

@section('content')

	<div class="row post-page form-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-center">
				<div class="mr-auto">
					<h1>Edit Post</h1>
				</div>
				<div class="">
					<a href="/posts/" class="btn btn-primary">Go Back</a>
				</div>
			</div>
			
			<div class="card post-card">
				{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				@if($post->image_name)
					<div class="edit-photo">
						<a href="#" class="delete-icon"><i class="fas fa-times"></i></a>
						<img src="/storage/uploaded_images/{{$post->image_name}}" class="img-fluid" id="post-image">
					</div>
					<a href="#" class="restore-icon"><i class="fas fa-undo-alt"></i> Undo Image Delete</a>
					{{Form::hidden('post_image', 'true', ['id' => 'image-exists'])}}
					{{Form::hidden('delete_image', 'false', ['id' => 'delete-image-checkbox'])}}
				@endif
					<div class="form-group">
						{{Form::textarea('content', $post->content, ['class' => 'form-control', 'id' => 'summary-ckeditor', 'rows' => 3])}}
					</div>
					{{Form::hidden('_method','PUT')}}
					{{Form::submit('Save', ['class' => 'btn btn-primary'])}}
				{!! Form::close() !!}
			</div>

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

	<!-- Script for text editor -->
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>

@endsection