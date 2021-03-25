@extends('layouts.app')

@section('content')
<script type="application/javascript" src="js/equipement-stock.js" defer></script>
<div class="container">
	<div class="row">
        <div class="col-md-12">
    		@can('create', \App\Bon::class)
    		<div class="d-flex justify-content-center pb-3">
                <div>
				    <div class="d-flex justify-content-center">
				    	@if($equipementStocks->count() != 0)
					    	<button class="btn btn-outline-warning mr-3" onclick="window.location.href='/bon-sortie/create'">Ajouter un bon de sortie</button>
					    	<button class="btn btn-outline-info mr-3" onclick="window.location.href='/bon-entree/create'">Ajouter un bon d'entrée</button>
				    	@endif
				    	<button class="btn btn-outline-danger mr-3" onclick="window.location.href='/bon-livraison/pdf'">Imprimer bon de livraison</button>
				    </div>
                </div>
            </div>
            <hr>
            @endcan
        	<div class="d-flex justify-content-center pb-3">
	            <h1>Liste des équipements du stock</h1>
	        </div>
	        <div class="d-flex justify-content-between pb-3">
	    		<div></div>
                @can('create', \App\EquipementStock::class)
	                <div>
	                    <button class="btn btn-outline-info" onclick="window.location.href='equipement-stock/create'">Ajouter un équipement</button>
	                </div>
                @endcan
            </div>
		    <table class="table">
		    	@if($equipementStocks->count() == 0)
			    	<tr>
		                <td colspan="6">Pas de données</td>
		            </tr>
	            @else
			        <tr>
			            <th>Id</th>
			            <th>Désignation</th>
			            <th>Marque</th>
			            <th>Model</th>
			            <th>N° Inv</th>
			            <th>Quantité</th>
			            <th></th>
			            @can('view', $equipementStocks[0])
				            <th></th>
				        @endcan
				        @can('update', $equipementStocks[0])
				            <th></th>
				        @endcan
				        @can('delete', $equipementStocks[0])
				            <th></th>
			            @endcan
			        </tr>
		            @foreach($equipementStocks as $eq)
		                <tr class="table-info" style="cursor: pointer;">
		                    <td onclick="afficher('{{ $eq->id }}')">{{ $eq->id }}</td>
		                    <td onclick="afficher('{{ $eq->id }}')">{{ $eq->designation }}</td>
		                    <td onclick="afficher('{{ $eq->id }}')">{{ $eq->marque }}</td>
		                    <td onclick="afficher('{{ $eq->id }}')">{{ $eq->model }}</td>
		                    <td onclick="afficher('{{ $eq->id }}')">{{ $eq->n_inv }}</td>
		                    <td onclick="afficher('{{ $eq->id }}')">{{ $eq->quantite }}</td>
		                    <td onclick="afficher('{{ $eq->id }}')"></td>
		                    @can('viewHistory', $eq)
		                        <td>
		                            <a href="/equipement-stock/{{ $eq->id }}/history" class="mr-2">
		                                <img src="/images/history.png" style="height: 15px; width: 15px;" alt="historique">
		                            </a>
		                        </td>
		                    @endcan
		                    @can('update', $eq)
		                        <td>
		                            <a href="/equipement-stock/{{ $eq->id }}/edit" class="mr-2">
		                                <img src="/images/edit.png" style="height: 15px; width: 15px;" alt="modifier">
		                            </a>
		                        </td>
		                    @endcan
		                    @can('delete', $eq)
		                        <td>
		                            <form action="/equipement-stock/{{ $eq->id }}" method="post">
		                                @csrf
		                                @method('DELETE')
		                                <button style="border: none; padding: 0px; background-color: transparent;"><img src="/images/delete.svg" style="height: 15px; width: 15px;" alt="supprimer"></button>
		                            </form>
		                        </td>
		                    @endcan
		                </tr>
		                @if($eq->pieces->count() == 0)
				        	<tr class="list{{ $eq->id }}" style="display: none;">
				                <td colspan="7">Pas de données</td>
				                @can('create', \App\Piece::class)
						            <th colspan="3">
						            	<button class="btn btn-outline-warning" onclick="window.location.href='equipement-stock/{{ $eq->id }}/piece/choose'">Ajouter une pièce</button>
						            </th>
						        @endcan
				            </tr>
				        @else
			                <tr class="list{{ $eq->id }}" style="display: none;">
					            <th>Id</th>
					            <th>Désignation</th>
					            <th>Marque</th>
					            <th>Model</th>
					            <th>N° Inv</th>
					            <th>Quantité</th>
					            <th>Quantité totale</th>
					            @can('create', \App\Piece::class)
						            <th colspan="3">
						            	<button class="btn btn-outline-warning" onclick="window.location.href='equipement-stock/{{ $eq->id }}/piece/choose'">Ajouter une pièce</button>
						            </th>
						        @endcan
					        </tr>
		                	@foreach($eq->pieces as $piece)
			                	<tr class="list{{ $eq->id }} table-warning" style="display: none;">
				                	<td>{{ $piece->id }}</td>
				                	<td>{{ $piece->designation }}</td>
			                        <td>{{ $piece->marque }}</td>
			                        <td>{{ $piece->model }}</td>
			                        <td>{{ $piece->n_inv }}</td>
			                        <td>{{ $piece->pivot->quantite_eq }} 
			                        	@can('update', $piece)
			                        		<a href="/equipement-stock/{{ $eq->id }}/piece/{{ $piece->id }}/edit" class="pl-3">
			                                	<img src="/images/edit.png" style="height: 15px; width: 15px;" alt="modifierQuantité">
			                            	</a>
			                            @endcan
				                    </td>
			                        <td>{{ $piece->quantite }}</td>
				                    @can('delete', $piece)
				                        <td>
				                            <form action="/equipement-stock/{{ $eq->id }}/piece/{{ $piece->id }}" method="post">
				                                @csrf
				                                @method('DELETE')
				                                <button style="border: none; padding: 0px; background-color: transparent;"><img src="/images/unlink.png" style="height: 15px; width: 15px;" alt="détacher"></button>
				                            </form>
				                        </td>
				                    @endcan
				                    @can('create', \App\Piece::class)
				                    	<td></td>
				                    	<td></td>
			                    	@endcan
			                	</tr>
		                	@endforeach
	                	@endif
		            @endforeach
		        @endif
		    </table>
		    <br>
		    <br>
		    <div class="d-flex justify-content-center pb-3">
	            <h1>Liste des pièces du stock</h1>
	        </div>
		    <table class="table">
		    	@if($pieces->count() == 0)
			    	<tr>
		                <td colspan="6">Pas de données</td>
		            </tr>
	            @else
			        <tr>
			            <th>Id</th>
			            <th>Désignation</th>
			            <th>Marque</th>
			            <th>Model</th>
			            <th>N° Inv</th>
			            <th>Quantité totale</th>
			            @can('view', $pieces[0])
				            <th></th>
				        @endcan
				        @can('update', $pieces[0])
				            <th></th>
				        @endcan
				        @can('delete', $pieces[0])
				            <th></th>
			            @endcan
			        </tr>
		            @foreach($pieces as $piece)
		                <tr class="table-warning">
		                    <td>{{ $piece->id }}</td>
		                    <td>{{ $piece->designation }}</td>
		                    <td>{{ $piece->marque }}</td>
		                    <td>{{ $piece->model }}</td>
		                    <td>{{ $piece->n_inv }}</td>
		                    <td>{{ $piece->quantite }}</td>
		                    @can('viewHistory', $piece)
		                        <td>
		                            <a href="/piece/{{ $piece->id }}/history" class="mr-2">
		                                <img src="/images/history.png" style="height: 15px; width: 15px;" alt="historique">
		                            </a>
		                        </td>
		                    @endcan
		                    @can('update', $piece)
		                        <td>
		                            <a href="/piece/{{ $piece->id }}/edit" class="mr-2">
		                                <img src="/images/edit.png" style="height: 15px; width: 15px;" alt="modifier">
		                            </a>
		                        </td>
		                    @endcan
		                    @can('delete', $piece)
		                        <td>
		                            <form action="/piece/{{ $piece->id }}" method="post">
		                                @csrf
		                                @method('DELETE')
		                                <button style="border: none; padding: 0px; background-color: transparent;"><img src="/images/delete.svg" style="height: 15px; width: 15px;" alt="supprimer"></button>
		                            </form>
		                        </td>
		                    @endcan
		                </tr>
		            @endforeach
		        @endif
		    </table>
		</div>
	</div>
</div>
@endsection
