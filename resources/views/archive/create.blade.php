@extends('layouts.app')

@section('content')

	<div class="row archive-create-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Archive: Create New</h1>
				</div>
				<div class="">
					<a href="/archive/" class="btn btn-secondary">Go Back</a>
				</div>
			</div>

			{!! Form::open(['action' => 'ArchiveController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				<div class="form-group">
					{{Form::label('id', 'Year:', ['class' => ''])}}
					{{Form::text('id', '', ['class' => 'form-control form-year', 'placeholder' => ''])}}
				</div>
				<div class="form-group">
					{{Form::label('league_champ_team', 'League Champ - Team:', ['class' => ''])}}
					{{Form::text('league_champ_team', '', ['class' => 'form-control', 'placeholder' => ''])}}
				</div>
				<div class="form-group">
					{{Form::label('most_points_team', 'Most Points - Team:', ['class' => ''])}}
					{{Form::text('most_points_team', '', ['class' => 'form-control', 'placeholder' => ''])}}
				</div>
				<div class="form-group">
					{{Form::label('most_points_value', 'Most Points - Value:', ['class' => ''])}}
					{{Form::text('most_points_score', '', ['class' => 'form-control', 'placeholder' => ''])}}
				</div>
				<div class="form-group">
					{{Form::label('highest_week_team', 'Highest Week - Team:', ['class' => ''])}}
					{{Form::text('highest_week_team', '', ['class' => 'form-control', 'placeholder' => ''])}}
				</div>
				<div class="form-group">
					{{Form::label('highest_week_value', 'Highest Week - Value:', ['class' => ''])}}
					{{Form::text('highest_week_score', '', ['class' => 'form-control', 'placeholder' => ''])}}
				</div>
				<div class="form-group">
					<label></label>
					{{Form::submit('Submit', ['class' => 'btn btn-primary form-submit'])}}
				</div>
			{!! Form::close() !!}

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection