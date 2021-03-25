@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/equipement/{{ $equipement->id }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Modifier un équipement</h1>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-md-4 col-form-label">Désignation</label>

                    <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ $equipement->designation }}" autocomplete="designation" autofocus required>

                    @error('designation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="marque" class="col-md-4 col-form-label">Marque</label>

                    <input id="marque" type="text" class="form-control @error('marque') is-invalid @enderror" name="marque" value="{{ $equipement->marque }}" autocomplete="marque" required>

                    @error('marque')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="model" class="col-md-4 col-form-label">Model</label>

                    <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ $equipement->model }}" autocomplete="model" required>

                    @error('model')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="n_inv" class="col-md-4 col-form-label">N° Inv</label>

                    <input id="n_inv" type="text" class="form-control @error('n_inv') is-invalid @enderror" name="n_inv" value="{{ $equipement->n_inv ?? '' }}" autocomplete="n_inv">

                    @error('n_inv')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="date_mise_service" class="col-md-4 col-form-label">Date mise en service</label>

                    @if($equipement->date_mise_service != null)
                        <input id="date_mise_service" type="date" class="form-control @error('date_mise_service') is-invalid @enderror" name="date_mise_service" value="{{ date('Y-m-d', strtotime($equipement->date_mise_service)) }}" autocomplete="date_mise_service">
                    @else
                        <input id="date_mise_service" type="date" class="form-control @error('date_mise_service') is-invalid @enderror" name="date_mise_service" value="" autocomplete="date_mise_service">
                    @endif

                    @error('date_mise_service')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row pt-2">
                    <label for="oui" class="col-md-2">Fonctionnel</label>

                    @if($equipement->fonctionnel == 'oui')                                
                        <input id="oui" type="radio" class="col-md-2 @error('oui') is-invalid @enderror" name="fonctionnel" value="oui" autocomplete="oui" checked>
                    @else
                        <input id="oui" type="radio" class="col-md-2 @error('oui') is-invalid @enderror" name="fonctionnel" value="oui" autocomplete="oui">
                    @endif

                    @error('oui')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="anomalie" class="col-md-2">fonctionnel avec anomalie</label>

                    @if($equipement->fonctionnel == 'anomalie')
                        <input id="anomalie" type="radio" class="col-md-2 @error('anomalie') is-invalid @enderror" name="fonctionnel" value="anomalie" autocomplete="anomalie" checked>
                    @else
                        <input id="anomalie" type="radio" class="col-md-2 @error('anomalie') is-invalid @enderror" name="fonctionnel" value="anomalie" autocomplete="anomalie">
                    @endif

                    @error('anomalie')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="non" class="col-md-2">Non fonctionnel</label>

                    @if($equipement->fonctionnel == 'non')
                        <input id="non" type="radio" class="col-md-2 @error('non') is-invalid @enderror" name="fonctionnel" value="non" autocomplete="non" checked>
                    @else
                        <input id="non" type="radio" class="col-md-2 @error('non') is-invalid @enderror" name="fonctionnel" value="non" autocomplete="non">
                    @endif

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
