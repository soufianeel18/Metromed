@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/market/{{ $market->id }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Modifier un marché</h1>
                </div>
                <div class="form-group row">
                    <label for="n_market" class="col-md-4 col-form-label">N° Marché</label>

                    <input id="n_market" type="text" class="form-control @error('n_market') is-invalid @enderror" name="n_market" value="{{ $market->n_market }}" autocomplete="n_market" autofocus required>

                    @error('n_market')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="ville" class="col-md-4 col-form-label">Ville</label>

                    <input id="ville" type="text" class="form-control @error('ville') is-invalid @enderror" name="ville" value="{{ $market->ville }}" autocomplete="ville" autofocus required>

                    @error('ville')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">valider</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
