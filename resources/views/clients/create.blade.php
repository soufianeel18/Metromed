@extends('layouts.app')

@section('content')
<div class="container">
    @if($isMarket == true)
        <form action="/client/{{ $market->id }}" method="post">
    @else
        <form action="/client-bon-de-commande" method="post">
    @endif
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Ajouter un client</h1>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Nom du client</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus required>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label">Téléphone</label>

                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">

                    @error('phone')
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
