@extends('layouts.app')

@section('content')

	<div class="archive-page row">
		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
		<div class="col-lg-8 col-md-10 col-sm-12 col-12">

			<div class="d-flex flex-row align-items-end">
				<div class="mr-auto">
					<h1>Archive Year</h1>
				</div>
				<div class="">
						<a href="/archive/" class="btn btn-secondary">Go Back</a>
				</div>
			</div>

			<div class="row">
				<div class="archive-card col-sm-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex flex-row align-items-start">
								<div class="mr-auto">
									<h3>{{$archiveItem->id}}</h3>
								</div>
							</div>
						</div>
						<div class="card-body d-flex flex-column align-items-start">
							<div class="card-content mb-auto align-self-stretch">
								<span class="card-label">League Champ:</span>
								{{$archiveItem->league_champ_team}}<br>
								<span class="card-label">Most Points:</span>
								{{$archiveItem->most_points_team}} ({{$archiveItem->most_points_score}})<br>
								<span class="card-label">Highest Week:</span>
								{{$archiveItem->highest_week_team}} ({{$archiveItem->highest_week_score}})<br>
								@if(count($archiveItem->documents)>0)
								<span class="card-label">Documents:</span>
									<ul>
										@foreach($archiveItem->documents as $document)
											<li>{{$document->description}} - {{$document->file_name}}</li>
										@endforeach
									</ul>
								@endif
							</div>
							@if(Auth::user()->isAdmin())
								<div class="card-buttons align-self-stretch">
									<div class="d-flex flex-row align-items-start" style="">
										<div class="mr-auto"><a href="/archive/{{$archiveItem->id}}/edit" class="btn btn-primary">Edit</a></div>
										<div class="">
											{!!Form::open(['action' => ['ArchiveController@destroy', $archiveItem->id], 'method' => 'POST', 'class' => 'delete'])!!}
												{{Form::hidden('_method', 'DELETE')}}
												{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
											{!!Form::close()!!}
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>

		<div class="col-lg-2 col-md-1 col-sm-0 col-0"></div>
	</div>

	<script>
	    $(".delete").on("submit", function(){
	        return confirm("Delete this archive year?");
	    });
	</script>

@endsection