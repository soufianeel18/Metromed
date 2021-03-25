@extends('layouts.app')

@section('content')
<script type="application/javascript" src="/js/bon.js" defer></script>
<div class="container">
    <form action="/bon-entree" method="post">
        @csrf
        <div class="row">
            <div class="d-flex justify-content-center col-md-10 offset-1 pb-3">
                <h1>Ajouter un bon d'entrée</h1>
            </div>
            <div class="col-md-10 offset-1">
                <div class="card mb-3" id="eq_card">
                    <div class="card-header text-light bg-info d-flex justify-content-between align-items-center">
                        <span>Veuillez choisir un équipement et ses accessoires</span>
                        <button type="button" class="btn btn-outline-warning" onclick="changer('piece')">Pièce</button>
                    </div>
                    <div class="card-body p-3">
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Désignation</th>
                                <th>Marque</th>
                                <th>Model</th>
                                <th>N° Inv</th>
                                <th>Quantité totale</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($equipementStocks as $eq)
                                <tr class="table-info">
                                    <td>{{ $eq->id }}</td>
                                    <td>{{ $eq->designation }}</td>
                                    <td>{{ $eq->marque }}</td>
                                    <td>{{ $eq->model }}</td>
                                    <td>{{ $eq->n_inv }}</td>
                                    <td>{{ $eq->quantite }}</td>
                                    <td></td>
                                    <td><input class="eq_radios" id="{{ $eq->id }}" type="radio" name="eq_id" value="{{ $eq->id }}" onchange="afficher('{{ $eq->id }}')" required></td>
                                </tr>
                                @if($eq->pieces->count() != 0)
                                    <tr class="eq{{ $eq->id }}" style="display: none;">
                                        <th>Id</th>
                                        <th>Désignation</th>
                                        <th>Marque</th>
                                        <th>Model</th>
                                        <th>N° Inv</th>
                                        <th>Quantité</th>
                                        <th>Quantité totale</th>
                                        <th></th>
                                    </tr>
                                    @foreach($eq->pieces as $piece)
                                        <tr class="eq{{ $eq->id }} table-warning" style="display: none;">
                                            <td>{{ $piece->id }}</td>
                                            <td>{{ $piece->designation }}</td>
                                            <td>{{ $piece->marque }}</td>
                                            <td>{{ $piece->model }}</td>
                                            <td>{{ $piece->n_inv }}</td>
                                            <td>{{ $piece->pivot->quantite_eq }}</td>
                                            <td>{{ $piece->quantite }}</td>
                                            <td><input class="eqcheck{{ $eq->id }}" type="checkbox" name="eq{{ $eq->id }}[]" value="{{ $piece->id }}"></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card mb-3" id="piece_card" style="display: none;">
                    <div class="card-header text-light bg-info d-flex justify-content-between  align-items-center">
                        <span>Veuillez choisir la pièce</span>
                        <button type="button" class="btn btn-outline-warning" onclick="changer('eq')">Equipement</button>
                    </div>
                    <div class="card-body p-3">
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Désignation</th>
                                <th>Marque</th>
                                <th>Model</th>
                                <th>N° Inv</th>
                                <th>Quantité totale</th>
                                <th></th>
                            </tr>
                            @foreach($pieces as $piece)
                                <tr class="table-warning">
                                    <td>{{ $piece->id }}</td>
                                    <td>{{ $piece->designation }}</td>
                                    <td>{{ $piece->marque }}</td>
                                    <td>{{ $piece->model }}</td>
                                    <td>{{ $piece->n_inv }}</td>
                                    <td>{{ $piece->quantite }}</td>
                                    <td><input class="piece_radios" type="radio" name="piece_id" value="{{ $piece->id }}"></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header text-light bg-info">
                        <span>Informations sur le client</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group row">
                            <label for="name" class="col-form-label col-md-3">Nom</label>
                            <input id="name" type="text" class="form-control col-md-8" name="name" autocomplete="name" required>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-form-label col-md-3">Téléphone</label>
                            <input id="phone" type="text" class="form-control col-md-8" name="phone" autocomplete="phone" required>
                        </div>
                        <div class="form-group row">
                            <label for="n_market" class="col-form-label col-md-3">N° Marché</label>
                            <input id="n_market" type="text" class="form-control col-md-8" name="n_market" autocomplete="n_market">
                        </div>
                        <div class="form-group row">
                            <label for="ville" class="col-form-label col-md-3">Ville</label>
                            <input id="ville" type="text" class="form-control col-md-8" name="ville" autocomplete="ville">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header text-light bg-info">
                        <span>Informations sur le bon</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group row">
                            <label for="date_entree" class="col-form-label col-md-3">Date d'entrée</label>

                            <input id="date_entree" type="datetime-local" class="form-control col-md-8 @error('date_entree') is-invalid @enderror" name="date_entree" autocomplete="date_entree" required>

                            @error('date_entree')
                            <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="quantite" class="col-form-label col-md-3">Quantité d'équipement</label>

                            <input id="quantite" type="number" class="form-control col-md-8 @error('quantite') is-invalid @enderror" name="quantite" autocomplete="quantite" required="">

                            @error('quantite')
                            <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center col-md-10 offset-1">
                <button class="btn btn-info">Valider</button>
            </div>
        </div>
    </form>
</div>
@endsection
