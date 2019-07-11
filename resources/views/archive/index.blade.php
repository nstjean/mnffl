@extends('layouts.app')

@section('content')

	<div class="archive-page">

		<div class="d-flex flex-row align-items-end">
			<div class="mr-auto">
				<h1>Archive Index</h1>
			</div>
			<div class="">
				<a href="/archive/create" class="btn btn-primary">Create New</a>
			</div>
		</div>

		@if(count($archive)>0)
			<div class="row">
				@foreach($archive as $archiveItem)
					<div class="archive-card col-lg-4 col-md-6">
						<div class="card">
							<div class="card-header">
								<div class="d-flex flex-row align-items-start">
									<div class="mr-auto">
										<h3><a href="/archive/{{$archiveItem->id}}">{{$archiveItem->id}}</a></h3>
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
								<div class="card-buttons align-self-stretch">
									<div class="d-flex flex-row align-items-start" style="">
										<div class="mr-auto"><a href="/archive/{{$archiveItem->id}}/edit" class="btn btn-sm btn-primary">Edit</a></div>
										<div class="">
											{!!Form::open(['action' => ['ArchiveController@destroy', $archiveItem->id], 'method' => 'POST', 'class' => 'delete'])!!}
												{{Form::hidden('_method', 'DELETE')}}
												{{Form::submit('Delete', ['class' => 'btn btn-sm btn-danger'])}}
											{!!Form::close()!!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<p>No posts found</p>
		@endif

	</div>

	<script>
	    $(".delete").on("submit", function(){
	        return confirm("Delete this archive year?");
	    });
	</script>

@endsection