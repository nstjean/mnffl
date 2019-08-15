@extends('layouts.app')

@section('content')

	<div class="archive-page">

		<div class="d-flex flex-row align-items-center">
			<div class="mr-auto">
				<h1>Archive Index</h1>
			</div>
			@if(Auth::user()->isAdmin())
				<div class="">
					<a href="/archive/create" class="btn btn-primary">Create New</a>
				</div>
			@endif
		</div>

		@if(count($archive)>0)
			<div class="row">
				@foreach($archive as $archiveItem)
					<div class="archive-card col-lg-4 col-md-6">
						<div class="card">
							@if(Auth::user()->isAdmin())
								{{-- Card Header For Admins --}}
								<div class="card-header card-header-divided clickable-row">
									<a href="/archive/{{$archiveItem->id}}/edit" class="card-header-left archive-title-link">
										{{-- <div class="hover-icon"><i class="fas fa-caret-right"></i></div> --}}
										<h3>{{$archiveItem->id}}</h3>
										<div class="hover-icon right-side"><i class="fas fa-edit"></i></div>
									</a>
					            	{{-- drop-down menu for edit/delete --}}
{{-- 									<div class="card-header-right dropdown show">
							            <a id="dropdownMenu{{ $archiveItem->id }}" class="dropdown-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							            	<i class="fas fa-ellipsis-h"></i>
							            </a>
						                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $archiveItem->id }}">
						                    <a class="dropdown-item" href="/archive/{{$archiveItem->id}}/edit">
						                        Edit Archive
						                    </a>
						                    <div class="dropdown-divider"></div>
						                    <a class="dropdown-item delete-anchor" href="#" data-value="delete-form{{ $archiveItem->id }}">
						                        {{ __('Delete') }}
						                    </a>
						                    {!!Form::open(['action' => ['ArchiveController@destroy', $archiveItem->id], 'method' => 'POST', 'class' => 'delete-hidden', 'id' => 'delete-form'.$archiveItem->id])!!}
						                        @csrf
												{{Form::hidden('_method', 'DELETE')}}
											{!!Form::close()!!}
						                </div> 
									</div>--}}
								</div>
							@else
								{{-- Card Header For Users --}}
								<div class="card-header">
									<h3>{{$archiveItem->id}}</h3>
								</div>
							@endif
							{{-- Card Body --}}
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
												<li>
													@if($document->description)
														<a href="storage/documents/{{$document->file_name}}">{{$document->description}}</a>
													@else
														<a href="storage/documents/{{$document->file_name}}">{{$document->getFileNameShort()}}</a>
													@endif
												</li>
											@endforeach
										</ul>
									@endif
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
	
@endsection