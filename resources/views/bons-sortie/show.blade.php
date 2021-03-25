@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
	            <div class="card-header text-light bg-info d-flex justify-content-between">
	            	<span>Bon de sortie</span>
	            	<div class="d-flex">
	            		@can('viewHistory', $bon)
	            			<a href="/bon-sortie/{{ $bon->id }}/history" class="pr-2"><img src="/images/history.png" style="height: 16px; width: 16px;" alt="historique"></a>
	            		@endcan
	            		@can('update', $bon)
	            			<a style="cursor: pointer" data-toggle="modal" data-target="#bonModal" class="pr-2"><img src="/images/edit.png" style="height: 16px; width: 16px;" alt="modifier"></a>
	            		@endcan
	            		@can('delete', $bon)
		            		<form action="/bon-sortie/{{ $bon->id }}" method="post">
		            			@csrf
	                    		@method('DELETE')
								<button style="border: none; padding: 0px; background-color: transparent;"><img src="/images/delete.svg" style="height: 16px; width: 16px;" alt="supprimer"></button>
							</form>
						@endcan
	            	</div>
	            </div>
				<div class="card-body">
					<span><strong>Date de sortie : </strong>{{ \Carbon\Carbon::parse($bon->date)->translatedFormat('d F Y à H\hi') }}</span>
					<hr>
					<span><strong>Quantité : </strong>{{ $bon->quantite }}</span>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-4">
	            <div class="card-header text-light bg-info">Client</div>
				<div class="card-body">
					<span><strong>Formation sanitaire : </strong>{{ $bon->cname }}</span>
					<hr>
					<span><strong>Téléphone : </strong>{{ $bon->cphone }}</span>
					@if($bon->n_market != null)
						<hr>
						<span><strong>Marché : </strong>{{ $bon->n_market }} {{ $bon->ville }}</span>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-4">
				@if($bon->equipement_stock_id != null)
	            	<div class="card-header text-light bg-info">Equipement</div>
	            @else
	            	<div class="card-header text-light bg-info">Pièce</div>
	            @endif
				<div class="card-body">
					@if($bon->equipement_stock_id != null)
                        <span><strong>Equipement : </strong></span>
                        <table class="table">
                        	<tr>
                        		<th>Id</th>
                        		<th>Désignation</th>
                        		<th>Marque</th>
                        		<th>Model</th>
                        		<th>N° Inv</th>
                        		<th>Quantité totale</th>
                        	</tr>
                            <tr class="table-info">
                                <td>{{ $bon->equipementStock->id }}</td>
                                <td>{{ $bon->equipementStock->designation }}</td>
                                <td>{{ $bon->equipementStock->marque }}</td>
                                <td>{{ $bon->equipementStock->model }}</td>
                                <td>{{ $bon->equipementStock->n_inv }}</td>
                                <td>{{ $bon->equipementStock->quantite }}</td>
                            </tr>
                        </table>
                        @if($bon->bonPieces->count() != 0)
                            <hr>
                            <span><strong>Pièces : </strong></span>
                            <table class="table">
                                <tr>
	                        		<th>Id</th>
	                        		<th>Désignation</th>
	                        		<th>Marque</th>
	                        		<th>Model</th>
	                        		<th>N° Inv</th>
	                        		<th>Quantité Pour l'équipement</th>
	                        	</tr>
                                @foreach($bon->bonPieces as $piece)
                                <tr class="table-warning">
                                	<td>{{ $piece->id }}</td>
                                    <td>{{ $piece->designation }}</td>
                                    <td>{{ $piece->marque }}</td>
                                    <td>{{ $piece->model }}</td>
                                    <td>{{ $piece->n_inv }}</td>
                                    <td>{{ $piece->quantite_eq }}</td>
                                </tr>
                                @endforeach
                            </table>
                        @endif
                    @else
                        <span><strong>Pièce : </strong></span>
                        <table class="table">
                            <tr>
                        		<th>Id</th>
                        		<th>Désignation</th>
                        		<th>Marque</th>
                        		<th>Model</th>
                        		<th>N° Inv</th>
                        		<th>Quantité totale</th>
                        	</tr>
                            <tr class="table-warning">
                            	<td>{{ $bon->piece->id }}</td>
                                <td>{{ $bon->piece->designation }}</td>
                                <td>{{ $bon->piece->marque }}</td>
                                <td>{{ $bon->piece->model }}</td>
                                <td>{{ $bon->piece->n_inv }}</td>
                                <td>{{ $bon->piece->quantite }}</td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
		</div>
	</div>
	@can('viewAny', \App\Bon::class)
		<div class="row d-flex justify-content-center pt-2">
			<button class="btn btn-danger" onclick="window.location.href='/bon'">Vers tous les bons</button>
		</div>
	@endcan
	@include('bons-sortie.edit')
</div>
@endsection