@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="row">
                <h1>Lier une pièce avec un équipement</h1>
            </div>
            <br>
            <br>
            <div class="row">
                <h6 class="pb-md-3">Veuillez choisir des pièces à lier</h6>
            </div>
            <form action="/piece/{{ $equipement_stock->id }}/link" method="post">
                @csrf
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
							<td><input type="checkbox" name="id[]" value="{{ $piece->id }}"></td>
						</tr>
                        <tr>
                            <td colspan="2">
                                <label for="{{ $piece->id }}">Quantité avec équipement</label>
                            </td>
                            <td colspan="4">
                                <input type="number" class="form-control @error('quantite_eq') is-invalid @enderror" name="{{ $piece->id }}" autocomplete="quantite_eq">
                                @error('quantite_eq')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </table>
                <a href="/equipement-stock/{{ $equipement_stock->id }}/piece/create" class="text-blue font-weight-bold">Ajouter une autre pièce...</a><br>
                <button class="btn btn-primary mt-3">Valider</button>
            </form>
        </div>
    </div>
</div>
@endsection