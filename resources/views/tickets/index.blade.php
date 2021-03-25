@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center pb-3">
            <h1>Liste des interventions</h1>
        </div>
        <div class="col-md-12 pb-5">
            <form action="/ticket/search" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-11 pt-2">
                        <input id="cle" type="text" class="form-control" name="cle" placeholder="Par titre, par date, par technicien, par commercial, par marché, par client, par équipement..." value="{{ $cle ?? '' }}" autofocus required>
                    </div>
                    <div class="col-md-1 pt-2">
                        <button class="btn btn-info">Chercher</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 d-flex justify-content-center pb-5">
            @if(Auth::User()->role == 'admin' || Auth::User()->role == 'technicien' || Auth::User()->role == 'chef technicien')
                <form action="/ticket/search" method="post">
                    @csrf
                    <div class="pr-2">
                        <input id="cle" type="text" name="cle" value="technique" hidden>
                        @if($cle == "technique")
                            <button class="btn btn-info">Technique</button>
                        @else
                            <button class="btn btn-outline-info">Technique</button>
                        @endif
                    </div>
                </form>
            @endif
            @if(Auth::User()->role == 'admin' || Auth::User()->role == 'commercial' || Auth::User()->role == 'chef commercial')
                <form action="/ticket/search" method="post">
                    @csrf
                    <div class="pr-2">
                        <input id="cle" type="text" name="cle" value="commerciale" hidden>
                        @if($cle == "commerciale")
                            <button class="btn btn-info">Commerciale</button>
                        @else
                            <button class="btn btn-outline-info">Commerciale</button>
                        @endif
                    </div>
                </form>
            @endif
            <form action="/ticket/search" method="post">
                @csrf
                <div class="pr-2">
                    <input id="cle" type="text" name="cle" value="administrative" hidden>
                    @if($cle == "administrative")
                        <button class="btn btn-info">Administrative</button>
                    @else
                        <button class="btn btn-outline-info">Administrative</button>
                    @endif
                </div>
            </form>
            <div>
                @if($cle == null)
                    <button class="btn btn-info" onclick="window.location.href='/ticket'">Tout</button>
                @else
                    <button class="btn btn-outline-info" onclick="window.location.href='/ticket'">Tout</button>
                @endif
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center pb-5">
            <form action="/ticket/search" method="post">
                @csrf
                <div class="pr-2">
                    <input id="cle" type="text" name="cle" value="en cours" hidden>
                    @if($cle == "en cours")
                        <button class="btn btn-success">En cours</button>
                    @else
                        <button class="btn btn-outline-success">En cours</button>
                    @endif
                </div>
            </form>
            <form action="/ticket/search" method="post">
                @csrf
                <div class="pr-2">
                    <input id="cle" type="text" name="cle" value="fermée" hidden>
                    @if($cle == "fermée")
                        <button class="btn btn-danger">Fermée</button>
                    @else
                        <button class="btn btn-outline-danger">Fermée</button>
                    @endif
                </div>
            </form>
            <form action="/ticket/search" method="post">
                @csrf
                <div class="pr-2">
                    <input id="cle" type="text" name="cle" value="archivée" hidden>
                    @if($cle == "archivée")
                        <button class="btn btn-secondary">Archivée</button>
                    @else
                        <button class="btn btn-outline-secondary">Archivée</button>
                    @endif
                </div>
            </form>
            <div>
                @if($cle == null)
                    <button class="btn btn-info" onclick="window.location.href='/ticket'">Tout</button>
                @else
                    <button class="btn btn-outline-info" onclick="window.location.href='/ticket'">Tout</button>
                @endif
            </div>
        </div>
        @if($tickets->count() == 0)
            <div class="col-md-12 d-flex justify-content-center">
                <span>Pas de données</span>
            </div>
        @else
        @foreach($tickets as $ticket)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header text-light bg-info d-flex justify-content-between">
                        @if($ticket->equipement_id == null)
                            @if($ticket->client_id == null)
                                <div>Ticket administratif</div>
                                <div>
                                    <a href="/ticket-admin/{{ $ticket->id }}" class="text-light font-weight-bold">Plus de détails...</a>
                                </div>
                            @else 
                                <div>Ticket commercial</div>
                                <div>
                                    <a href="/ticket-comm/{{ $ticket->id }}" class="text-light font-weight-bold">Plus de détails...</a>
                                </div>
                            @endif
                        @else 
                            <div>Ticket technique</div>
                            <div>
                                <a href="/ticket-tech/{{ $ticket->id }}" class="text-light font-weight-bold">Plus de détails...</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div><span><strong>Date de création : </strong>{{ \Carbon\Carbon::parse($ticket->created_at)->translatedFormat('d F Y à H\hi') }}</span></div>
                            @if($ticket->equipement_id == null)
                                @if($ticket->client_id == null)
                                    @can('viewHistory', $ticket)
                                        <div><a href="/ticket-admin/{{ $ticket->id }}/history" class="pr-1"><img src="/images/history.png" style="height: 16px; width: 16px;" alt="historique"></a></div>
                                    @endcan
                                @else 
                                    @can('viewHistory', $ticket)
                                        <div><a href="/ticket-comm/{{ $ticket->id }}/history" class="pr-1"><img src="/images/history.png" style="height: 16px; width: 16px;" alt="historique"></a></div>
                                    @endcan
                                @endif
                            @else
                                @can('viewHistory', $ticket)
                                    <div><a href="/ticket-tech/{{ $ticket->id }}/history" class="pr-1"><img src="/images/history.png" style="height: 16px; width: 16px;" alt="historique"></a></div>
                                @endcan
                            @endif
                        </div>
                        <hr>
                        <span><strong>Titre : </strong>{{ $ticket->title }}</span>
                        <hr>
                        <span><strong>Etat : </strong>
                            @switch($ticket->status)
                            @case("en cours")
                                <strong  class="text-success">{{ $ticket->status }}</strong>
                            @break
                            @case("fermée")
                                <strong  class="text-danger">{{ $ticket->status }}</strong>
                            @break
                            @case("archivée")
                                <strong  class="text-secondary">{{ $ticket->status }}</strong>
                            @break
                            @endswitch
                        </span>
                        <hr>
                        <span><strong>Date du début : </strong>{{ \Carbon\Carbon::parse($ticket->start_date)->translatedFormat('d F Y à H\hi') }}</span>
                        <hr>
                        <span><strong>Date de fin : </strong>{{ \Carbon\Carbon::parse($ticket->end_date)->translatedFormat('d F Y à H\hi') }}</span>
                        @if($ticket->type != null)
                            <hr>
                            <span><strong>Type : </strong>{{ $ticket->type }}</span>
                        @endif
                        @if($ticket->equipement_id == null)
                            @if($ticket->client_id == null)
                                @if($ticket->user->role == 'technicien')
                                    <hr>
                                    <span><strong>Technicien : </strong>{{ $ticket->user->name }}</span>
                                @else
                                    <hr>
                                    <span><strong>Commercial : </strong>{{ $ticket->user->name }}</span>
                                @endif
                            @else 
                                <hr>
                                <span><strong>Commercial : </strong>{{ $ticket->user->name }}</span>
                                <hr>
                                <span><strong>Client : </strong>{{ $ticket->client->name }}</span>
                                @if($ticket->client->market_id != null)
                                    <hr>
                                    <span><strong>Marché : </strong>{{ $ticket->client->market->n_market }} {{ $ticket->client->market->ville }}</span>
                                @endif
                            @endif
                        @else 
                            <hr>
                            <span><strong>Technicien : </strong>{{ $ticket->user->name }}</span> 
                            <hr>
                            <span><strong>Equipement : </strong>{{ $ticket->equipement->designation }}</span> 
                            <hr>
                            <span><strong>Client : </strong>{{ $ticket->equipement->client->name }}</span> 
                            @if($ticket->equipement->client->market_id != null)
                                <hr>
                                <span><strong>Marché : </strong>{{ $ticket->equipement->client->market->n_market }} {{ $ticket->equipement->client->market->ville }}</span>
                            @endif    
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>
@endsection