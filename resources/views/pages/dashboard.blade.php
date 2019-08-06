@extends('layouts.app')

@section('content')

	<div class="row dashboard-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Dashboard</h1>
				</div>
			</div>

			@if(Auth::user()->isAdmin())
			<section class="card mb-3">
				<div class="card-header">
					<h3>Administrator Dashboard</h3>
				</div>
				<div class="card-body">
					<a href="{{ url('/users/create/') }}" class="btn btn-sm btn-primary">Add New User</a>
					<a href="{{ url('/users/') }}" class="btn btn-sm btn-primary">Edit Users</a>
				</div>
			</section>
			@endif

			<section class="card mb-3">
				<div class="card-header">
					<h3>My Profile</h3>
				</div>
				<div class="card-body row">
					<div class="col-md-2">
						@if(Auth::user()->profile_pic)
							<img src="{{ Auth::user()->profile_pic }}" class="profile-pic">
						@endif
					</div>
					<div class="col-md-10">
						<div class="row">
							<div class="label col-md-3 col-sm-6">Name:</div>
							<div class="info col-md-9 col-sm-6">{{ Auth::user()->name }}</div>
						</div>
						<div class="row">
							<div class="label col-md-3 col-sm-6">Email:</div>
							<div class="info col-md-9 col-sm-6">{{ Auth::user()->email }}</div>
						</div>
						<div class="row">
							<div class="label col-md-3 col-sm-6">Team:</div>
							<div class="info col-md-9 col-sm-6">{{ Auth::user()->team_name }}</div>
						</div>
						<div>
							<a href="" class="btn btn-sm btn-primary">Edit My Profile</a>
						</div>
					</div>
				</div>
			</section>

			<section class="card mb-3">
				<div class="card-header">
					<h3>My Recent Posts</h3>
				</div>
				<div class="card-body p-0">
					<ul class="list-group list-group-flush">
						@if(count($posts)>0)
							@foreach($posts as $post)
								<li class="list-group-item">
									<div class="card-dashboard-list-item row">
										<div class="col-md-2 col-sm-4 col-12">{{ $post->created_at->format('m/j/y') }}</div>
										<div class="col-md-10 col-sm-8 col-12">{{ substr($post->content, 0, 40) }}</div>
									</div>
								</li>
							@endforeach
						@else
							<li class="list-group-item">No posts found</li>
						@endif
					</ul>
					{{$posts->links()}}
				</div>
			</section>

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection