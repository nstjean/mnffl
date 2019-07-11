@extends('layouts.app')

@section('content')

	<div class="row post-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Posts Index</h1>
				</div>
				<div class="">
					<a href="/posts/create" class="btn btn-primary">Create A Post</a>
				</div>
			</div>
			@if(count($posts)>0)
				@foreach($posts as $post)
					<div class="card post-card">
						<div class="card-body">
							<div class="card-content">{{$post->content}}</div>
							<div class="card-buttons d-flex flex-row align-items-end">
								<div class="card-small">Posted on {{ $post->created_at->format('F j, Y \a\t h:ma') }}</div>
								<div class="mr-auto"><a href="/posts/{{$post->id}}/edit" class="btn btn-sm btn-primary">Edit</a></div>
								<div class="">
									{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'delete'])!!}
										{{Form::hidden('_method', 'DELETE')}}
										{{Form::submit('Delete', ['class' => 'btn btn-sm btn-danger'])}}
									{!!Form::close()!!}
								</div>
							</div>
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

	<script>
	    $(".delete").on("submit", function(){
	        return confirm("Delete this post?");
	    });
	</script>

@endsection