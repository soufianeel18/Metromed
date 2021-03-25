@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @can('viewAny', \App\User::class)
            @if(Auth::User()->role != 'admin')
                <div class="col-md-3 pt-md-1 pb-3">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary" onclick="window.location.href='/user'" style="width: 100%">Gérer les utilisateurs</button>
                    </div>
                    <hr>
                </div>
                <div class="col-md-9">
            @else
                <div class="col-md-12">
            @endif
        @else
            <div class="col-md-12">
        @endcan
            <div id="app">
                <example-component tickets='{!! json_encode($bons) !!}'></example-component>
            </div>
        </div>
    </div>
</div>
@endsection