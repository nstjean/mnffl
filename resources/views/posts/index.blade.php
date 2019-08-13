@extends('layouts.app')

@section('content')

	<div class="row post-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<!-- PAGE TOP / BUTTON -->
			<div class="d-flex flex-row align-items-center">
				<div class="mr-auto">
					<h1>Posts</h1>
				</div>
				<div class="">
					<a href="/posts/create" class="btn btn-primary">Create A Post</a>
				</div>
			</div>
			<!-- POSTS -->
			@if(count($posts)>0)
				@foreach($posts as $post)
					<div class="card post-card">

						{{-- Post Header --}}
						<div class="card-header">
							<div class="card-header-left">
								{{-- Poster Name --}}
								<div class="card-name">{{ $post->user->name }}</div>
								<div class="card-small">Posted on {{ $post->created_at->format('F j, Y \a\t h:ma') }}</div>
							</div>
							<div class="card-header-right dropdown show">
								{{-- Dropdown Menu --}}
					            <a id="dropdownMenu{{ $post->id }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					            	<i class="fas fa-ellipsis-h"></i>
					            </a>

				                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $post->id }}">
				                    <a class="dropdown-item" href="/posts/{{$post->id}}/edit">
				                        Edit Post
				                    </a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete-anchor" href="#" data-value="delete-form{{ $post->id }}">
				                        {{ __('Delete') }}
				                    </a>
				                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'delete-post', 'id' => 'delete-form'.$post->id])!!}
				                        @csrf
										{{Form::hidden('_method', 'DELETE')}}
									{!!Form::close()!!}
				                </div>
							</div>
						</div>

						{{-- Post Body --}}
						<div class="card-body">
							
							@if($post->image_name)
								<div class="card-photo"><img src="/storage/uploaded_images/{{$post->image_name}}" class="img-fluid"></div>
							@endif
							<div class="card-content">{!! $post->content !!}</div>
						</div>

					</div>
				@endforeach
				{{$posts->links()}}
			@else
				<p>No posts found</p>
			@endif

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection