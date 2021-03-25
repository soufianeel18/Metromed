@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center pb-3">
            <h1>Liste des bons</h1>
        </div>
        <div class="col-md-12 pb-5">
            <form action="/bon/search" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-11 pt-2">
                        <input id="cle" type="text" class="form-control" name="cle" placeholder="Par date (yyyy-mm-dd), par marché, par client, par équipement, par pièce..." value="{{ $cle ?? '' }}" autofocus required>
                    </div>
                    <div class="col-md-1 pt-2">
                        <button class="btn btn-info">Chercher</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 d-flex justify-content-center pb-5">
            <form action="/bon/search" method="post">
                @csrf
                <div class="pr-2">
                    <input id="cle" type="text" name="cle" value="sortie" hidden>
                    @if($cle == "sortie")
                        <button class="btn btn-info">Sortie</button>
                    @else
                        <button class="btn btn-outline-info">Sortie</button>
                    @endif
                </div>
            </form>
            <form action="/bon/search" method="post">
                @csrf
                <div class="pr-2">
                    <input id="cle" type="text" name="cle" value="entrée" hidden>
                    @if($cle == "entrée")
                        <button class="btn btn-info">Entrée</button>
                    @else
                        <button class="btn btn-outline-info">Entrée</button>
                    @endif
                </div>
            </form>
            <div>
                @if($cle == null)
                    <button class="btn btn-info" onclick="window.location.href='/bon'">Tout</button>
                @else
                    <button class="btn btn-outline-info" onclick="window.location.href='/bon'">Tout</button>
                @endif
            </div>
        </div>
        @if($bons->count() == 0)
            <div class="col-md-12 d-flex justify-content-center">
                <span>Pas de données</span>
            </div>
        @else
        @foreach($bons as $bon)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header text-light bg-info d-flex justify-content-between">
                        @if($bon->type == 'entrée')
                            <div>Bon d'entrée</div>
                            @can('view', $bon)
                                <div>
                                    <a href="/bon-entree/{{ $bon->id }}" class="text-light font-weight-bold">Plus de détails...</a>
                                </div>
                            @endcan
                        @else
                            <div>Bon de sortie</div>
                            @can('view', $bon)
                                <div>
                                    <a href="/bon-sortie/{{ $bon->id }}" class="text-light font-weight-bold">Plus de détails...</a>
                                </div>
                            @endcan
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            @if($bon->type == 'entrée')
                                <div><span><strong>Date d'entrée : </strong>{{ \Carbon\Carbon::parse($bon->date)->translatedFormat('d F Y à H\hi') }}</span></div>
                                @can('viewHistory', $bon)
                                    <div><a href="/bon-entree/{{ $bon->id }}/history" class="pr-1"><img src="/images/history.png" style="height: 16px; width: 16px;" alt="historique"></a></div>
                                @endcan
                            @else 
                                <div><span><strong>Date de sortie : </strong>{{ \Carbon\Carbon::parse($bon->date)->translatedFormat('d F Y à H\hi') }}</span></div>
                                @can('viewHistory', $bon)
                                    <div><a href="/bon-sortie/{{ $bon->id }}/history" class="pr-1"><img src="/images/history.png" style="height: 16px; width: 16px;" alt="historique"></a></div>
                                @endcan
                            @endif
                        </div>
                        <hr>
                        <span><strong>Quantité : </strong>{{ $bon->quantite }}</span>
                        <hr>
                        <span><strong>Nom du client : </strong>{{ $bon->cname }}</span>
                        @if($bon->n_market != null)
                            <hr>
                            <span><strong>Marché : </strong>{{ $bon->n_market }} {{ $bon->ville }}</span>
                        @endif
                        @if($bon->equipement_stock_id != null)
                            <hr>
                            <span><strong>Equipement : </strong></span>
                            <table class="table">
                                <tr class="table-info">
                                    <td>{{ $bon->equipementStock->designation }}</td>
                                    <td>{{ $bon->equipementStock->marque }}</td>
                                    <td>{{ $bon->equipementStock->model }}</td>
                                    <td>{{ $bon->equipementStock->n_inv }}</td>
                                </tr>
                            </table>
                            @if($bon->bonPieces->count() != 0)
                                <hr>
                                <span><strong>Pièces : </strong></span>
                                <table class="table">
                                    @foreach($bon->bonPieces as $piece)
                                    <tr class="table-warning">
                                        <td>{{ $piece->designation }}</td>
                                        <td>{{ $piece->marque }}</td>
                                        <td>{{ $piece->model }}</td>
                                        <td>{{ $piece->n_inv }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            @endif
                        @else
                            <hr>
                            <span><strong>Pièce : </strong></span>
                            <table class="table">
                                <tr class="table-warning">
                                    <td>{{ $bon->piece->designation }}</td>
                                    <td>{{ $bon->piece->marque }}</td>
                                    <td>{{ $bon->piece->model }}</td>
                                    <td>{{ $bon->piece->n_inv }}</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>
@endsection