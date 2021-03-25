@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center pb-3">
                <h1>Liste des clients bon de commande</h1>
            </div>
            @can('create', \App\Client::class)
                <div class="d-flex justify-content-between pb-3">
                    <div></div>
                    <div>
                        <button class="btn btn-outline-info" onclick="window.location.href='/client-bon-de-commande/create'">Ajouter un client</button>
                    </div>
                </div>
            @endcan
            @if($clients->count() == 0)
                <div class="d-flex justify-content-center">
                    <span>Pas de données</span>
                </div>
            @else
                @foreach($clients as $client)
                    <div class="card mb-3">
                        <div class="card-header text-light bg-info d-flex justify-content-between align-items-center">
                            <div>{{ $client->name }}</div>
                            <div class="d-flex align-items-center">
                                @can('view', $client)
                                    <a href="/client/{{ $client->id }}" class="mr-3">
                                        <img src="/images/history.png" style="height: 15px; width: 15px;" alt="historique">
                                    </a>
                                @endcan
                                @can('update', $client)
                                    <a href="/client/{{ $client->id }}/edit" class="mr-3">
                                        <img src="/images/edit.png" style="height: 15px; width: 15px;" alt="modifier">
                                    </a>
                                @endcan
                                @can('delete', $client)
                                    <form action="/client/{{ $client->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button style="border: none; padding: 0px; background-color: transparent;"><img src="/images/delete.svg" style="height: 15px; width: 15px;" alt="supprimer"></button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                @if($client->equipements->count() == 0)
                                    <tr>
                                        @can('create', \App\Equipement::class)
                                            <td colspan="3">
                                                <button class="btn btn-outline-success" onclick="window.location.href='/client/{{ $client->id}}/equipement/create'">Ajouter un équipement</button>
                                            </td>
                                        @endcan
                                    </tr>
                                @else
                                    <tr>
                                        <th>Id</th>
                                        <th>Désignation</th>
                                        <th>Marque</th>
                                        <th>Model</th>
                                        <th>N° Inv</th>
                                        <th>Mise en service</th>
                                        @can('create', \App\Equipement::class)
                                            <th colspan="3">
                                                <button class="btn btn-outline-success" onclick="window.location.href='/client/{{ $client->id}}/equipement/create'">Ajouter un équipement</button>
                                            </th>
                                        @endcan
                                    </tr>
                                    @foreach($client->equipements as $eq)
                                        @switch($eq->fonctionnel)
                                            @case("oui")
                                                <tr class="table-success">
                                            @break
                                            @case("anomalie")
                                                <tr class="table-warning">
                                            @break
                                            @case("non")
                                                <tr class="table-danger">
                                            @break
                                            @default
                                                <tr>
                                        @endswitch
                                            <td>{{ $eq->id }}</td>
                                            <td>{{ $eq->designation }}</td>
                                            <td>{{ $eq->marque }}</td>
                                            <td>{{ $eq->model }}</td>
                                            <td>{{ $eq->n_inv }}</td>
                                            <td>{{ $eq->date_mise_service }}</td>
                                            @can('view', $eq)
                                                <td>
                                                    <a href="/equipement/{{ $eq->id }}" class="mr-2">
                                                        <img src="/images/history.png" style="height: 15px; width: 15px;" alt="historique">
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('update', $eq)
                                                <td>
                                                    <a href="/equipement/{{ $eq->id }}/edit" class="mr-2">
                                                        <img src="/images/edit.png" style="height: 15px; width: 15px;" alt="modifier">
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete', $eq)
                                                <td>
                                                    <form action="/equipement/{{ $eq->id }}" method="post">
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
                            <div class="d-flex align-items-center">
                                <div class="color-box bg-success rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                                <span style="font-size: 12px;">Fonctionnel</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="color-box bg-warning rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                                <span style="font-size: 12px;">Fonctionnel avec anomalie</span>
                            </div>
                            <div class="d-flex align-items-center pb-2">
                                <div class="color-box bg-danger rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                                <span style="font-size: 12px;">Non fonctionnel</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
