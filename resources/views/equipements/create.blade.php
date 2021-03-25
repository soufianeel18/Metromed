@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/equipement/{{ $client->id }}" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Ajouter un équipement</h1>
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
                    <label for="date_mise_service" class="col-md-4 col-form-label">date mise en service</label>

                    <input id="date_mise_service" type="date" class="form-control @error('date_mise_service') is-invalid @enderror" name="date_mise_service" value="{{ old('date_mise_service') }}" autocomplete="date_mise_service">

                    @error('date_mise_service')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row pt-2">
                    <label for="oui" class="col-md-2">Fonctionnel</label>

                    <input id="oui" type="radio" class="col-md-2 @error('oui') is-invalid @enderror" name="fonctionnel" value="oui" autocomplete="oui" checked="true">

                    @error('oui')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="anomalie" class="col-md-2">fonctionnel avec anomalie</label>

                    <input id="anomalie" type="radio" class="col-md-2 @error('anomalie') is-invalid @enderror" name="fonctionnel" value="anomalie" autocomplete="anomalie">

                    @error('anomalie')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="non" class="col-md-2">Non fonctionnel</label>

                    <input id="non" type="radio" class="col-md-2 @error('non') is-invalid @enderror" name="fonctionnel" value="non" autocomplete="non">

                    @error('non')
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
