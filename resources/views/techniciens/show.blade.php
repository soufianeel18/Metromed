@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                @if($user->color <= '#aaaaaa')
                    <tr style="background-color : {{ $user->color }}" class="text-light">
                @else
                    <tr style="background-color : {{ $user->color }}" class="text-dark">
                @endif
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        @can('createTicketTech', \App\Ticket::class)
            <div class="col-md-3 pt-md-1 pb-3">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#typeModal" style="width: 100%">Ajouter un ticket</button>
                </div>
                <hr>
            </div>
        @endcan
        @can('createTicketTech', \App\Ticket::class)
            <div class="col-md-9">
        @else
            <div class="col-md-12">
        @endcan
            <div id="app">
                <example-component tickets='{!! json_encode($tickets) !!}'></example-component>
            </div>
        </div>
    </div>
    @include('techniciens.type')
    @include('tickets-admin.create')
    @include('techniciens.list_market')
    @include('techniciens.list_bon')
</div>
@endsection