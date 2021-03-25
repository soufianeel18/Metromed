@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 offset-1">
			<div class="pb-5">
				<span class="h3"><strong>Historique : </strong></span>
				<span class="h4">Utilisateur {{ $user->username }}</span>
			</div>
		</div>
		<div class="col-md-10 offset-1">
			@foreach($events as $event)
		        <div class="card mb-3">
		        	<div class="card-header text-light bg-info">
		        		{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y à H\hi') }}
		            </div>
					<div class="card-body">
						<p style="white-space: pre-wrap;">{{ $event->description }}</p>
					</div>
				</div>
			@endforeach
			@if(Auth::User()->id != $user->id || Auth::User()->role != 'admin')
				@can('viewAny', \App\User::class)
					<div class="d-flex justify-content-center pt-3">
						<button class="btn btn-danger" onclick="window.location.href='/user'">Vers tous les utilisateurs</button>
					</div>
				@endcan
			@endif
		</div>
	</div>
</div>
@endsection
