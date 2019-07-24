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
					Stuff
				</div>
			</section>
			@endif

			<section class="card mb-3">
				<div class="card-header">
					<h3>My Profile</h3>
				</div>
				<div class="card-body">
					<div>
						Email Address:
					</div>
					<div>
						Team Name:
					</div>
					<div>
						Profile Pic:
					</div>
					<div>
						<a href="" class="btn btn-sm btn-primary">Edit My Profile</a>
					</div>
				</div>
			</section>

			<section class="card mb-3">
				<div class="card-header">
					<h3>My Recent Posts</h3>
				</div>
				<div class="card-body">

				</div>
			</section>

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection