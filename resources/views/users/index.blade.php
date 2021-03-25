@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center pb-3">
                <h1>Liste des utilisateurs</h1>
            </div>
            <div class="d-flex justify-content-between pb-3">
                <div></div>
                @can('create', \App\User::class)
                    <div>
                        <button class="btn btn-danger" onclick="window.location.href='/user/create'">Ajouter un utilisateur</button>
                    </div>
                @endcan
            </div>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th></th>
                    <th>Nom</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Date de création</th>
                    <th>Date de dernière connexion</th>
                    @if($users->count() != 0)
                        @can('viewHistory', $users[0])
                            <th></th>
                        @endcan
                    @endif
                    <th></th>
                </tr>
                @if($users->count() == 0)
                    <tr>
                        <td colspan="10">Pas de données</td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><div style="background-color : {{ $user->color }}; width: 20px; height: 20px;"></div></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y à H\hi') }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->date_cnx)->translatedFormat('d F Y à H\hi') }}</td>
                            @can('viewHistory', $user)
                                <td>
                                    <a href="/user/{{ $user->id }}/history" class="mr-2">
                                        <img src="/images/history.png" style="height: 20px; width: 20px;" alt="historique">
                                    </a>
                                </td>
                            @endcan
                            <td>
                                <a data-toggle="modal" data-target="#user{{ $user->id }}" style="cursor: pointer;">
                                    <img src="/images/setting.png" style="height: 20px; width: 20px;" alt="paramètres">
                                </a>
                                @include('users.choix')
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
