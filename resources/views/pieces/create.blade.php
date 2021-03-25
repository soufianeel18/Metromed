@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/piece/{{ $equipement_stock->id }}" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Ajouter une pièce</h1>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-md-4 col-form-label">Désignation</label>

                    <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation') }}" autocomplete="designation" autofocus required>

                    @error('designation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="marque" class="col-md-4 col-form-label">Marque</label>

                    <input id="marque" type="text" class="form-control @error('marque') is-invalid @enderror" name="marque" value="{{ old('marque') }}" autocomplete="marque" required>

                    @error('marque')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="model" class="col-md-4 col-form-label">Model</label>

                    <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model') }}" autocomplete="model" required>

                    @error('model')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="n_inv" class="col-md-4 col-form-label">N° Inv</label>

                    <input id="n_inv" type="text" class="form-control @error('n_inv') is-invalid @enderror" name="n_inv" value="{{ old('n_inv') }}" autocomplete="n_inv">

                    @error('n_inv')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="quantite" class="col-md-4 col-form-label">Quantité totale</label>

                    <input id="quantite" type="number" class="form-control @error('quantite') is-invalid @enderror" name="quantite" value="{{ old('quantite') }}" autocomplete="quantite" required>

                    @error('quantite')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="quantite_eq" class="col-md-4 col-form-label">Quantité avec équipement</label>

                    <input id="quantite_eq" type="number" class="form-control @error('quantite_eq') is-invalid @enderror" name="quantite_eq" value="{{ old('quantite_eq') }}" autocomplete="quantite_eq" required>

                    @error('quantite_eq')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
