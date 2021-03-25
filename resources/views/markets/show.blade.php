@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 offset-1">
			<div class="pb-5">
				<span class="h3"><strong>Historique : </strong></span>
				<span class="h4">Marché {{ $market->n_market }} {{ $market->ville }}</span>
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
			<div class="d-flex justify-content-center pt-3">
				<button class="btn btn-danger text-light" onclick="window.location.href='/market'">Vers tous les marchés</button>
			</div>
		</div>
	</div>
</div>
@endsection
