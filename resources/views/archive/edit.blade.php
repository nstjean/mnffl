@extends('layouts.app')

@section('content')

	<div class="row archive-create-page form-page">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-center">
				<div class="mr-auto">
					<h1>Archive: Edit</h1>
				</div>
				<div class="">
					<a href="/archive/" class="btn btn-primary">Go Back</a>
				</div>
			</div>

			<div class="card">
				{!! Form::open(['action' => ['ArchiveController@update', $archiveItem->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
					<div class="form-group">
						{{Form::label('id', 'Year:', ['class' => ''])}}
						{{Form::text('id', $archiveItem->id, ['class' => 'form-control form-year', 'readonly' => 'true'])}}
					</div>
					<div class="form-group">
						{{Form::label('league_champ_team', 'League Champ - Team Name:', ['class' => ''])}}
						{{Form::text('league_champ_team', $archiveItem->league_champ_team, ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('most_points_team', 'Most Points - Team Name:', ['class' => ''])}}
						{{Form::text('most_points_team', $archiveItem->most_points_team, ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('most_points_value', 'Most Points - Number Value:', ['class' => ''])}}
						{{Form::text('most_points_score', $archiveItem->most_points_score, ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('highest_week_team', 'Highest Week - Team Name:', ['class' => ''])}}
						{{Form::text('highest_week_team', $archiveItem->highest_week_team, ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('highest_week_value', 'Highest Week - Number Value:', ['class' => ''])}}
						{{Form::text('highest_week_score', $archiveItem->highest_week_score, ['class' => 'form-control'])}}
					</div>
					<div class="documents-label">
						{{Form::label('documents', 'Documents:', ['class' => ''])}}
					</div>
						@if(count($archiveItem->documents))
							@foreach($archiveItem->documents as $document)
								<div class="form-group form-group-documents">
									<label class="form-file-name"><a href="/storage/documents/{{$document->file_name}}">{{$document->getFileNameShort()}}</a></label>
									<div class="form-file-inputs">
										{{Form::text('documentNames['.$document->id.']', $document->description, ['class' => 'form-control form-file-description', 'placeholder' => ''])}}
										<div class="form-file-delete">
											{{Form::checkbox('documentDeletes['.$document->id.']', 'true', false, ['class' => 'delete-item'])}}
											<label class="delete-item">Delete</label>
										</div>
									</div>
								</div>
							@endforeach
						@else
								<div class="form-group form-group-documents">
									<label class="form-file-name"></label>
									<div class="form-file-inputs">No documents uploaded.</div>
								</div>
						@endif
					<div class="form-group form-group-upload">
						{{Form::label('documents', 'Upload New Documents:', ['class' => ''])}}
						{{Form::file('documents[]', ['multiple' => 'multiple'])}}
					</div>
					<div class="form-group mb-0">
						<label></label>
						{{Form::hidden('_method','PUT')}}
						{{Form::submit('Submit', ['class' => 'btn btn-primary form-submit'])}}
					</div>
				{!! Form::close() !!}
			</div>

		</div>
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

@endsection