@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 offset-1">
			<div class="pb-5">
				<span class="h3"><strong>Historique : </strong></span>
				<span class="h4">Equipement de stock {{ $equipement_stock->designation }} model {{ $equipement_stock->model }}</span>
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
				@can('viewAny', \App\EquipementStock::class)
					<button class="btn btn-danger text-light" onclick="window.location.href='/stock'">Vers tous les équipements de stock</button>
				@endcan
			</div>
		</div>
	</div>
</div>
@endsection
