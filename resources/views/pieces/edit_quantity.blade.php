@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/equipement-stock/{{ $equipement_stock->id }}/piece/{{ $piece->id }}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row pb-4">
                    <h1>Modifier la quantité d'une pièce avec équipement</h1>
                </div>
                <div class="form-group row">
                    <input id="quantite_eq" type="number" class="form-control @error('quantite_eq') is-invalid @enderror" name="quantite_eq" value="{{ $piece->equipementStocks()->find($equipement_stock->id)->pivot->quantite_eq }}" autocomplete="quantite_eq" required>

                    @error('quantite_eq')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-2">
                    <button class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
