@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 pt-md-1 pb-3">
            @can('viewAny', \App\User::class)
                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary" onclick="window.location.href='/user'" style="width: 100%">Gérer les utilisateurs</button>
                </div>
                <hr>
            @endcan
            @if($commerciaux->count() != 0)
                @can('view', $commerciaux[0])
                    <h4 class="pb-md-3">Commerciaux</h4>
                    <table class="table">
                        @foreach($commerciaux as $comm)
                            <tr style="background-color : {{ $comm->color }}">
                                <td style="cursor: pointer">
                                    @if($comm->color <= '#aaaaaa')
                                        <a href="/commercial/{{ $comm->id }}" class="text-light" style="text-decoration: none;">  
                                    @else
                                        <a href="/commercial/{{ $comm->id }}" class="text-dark" style="text-decoration: none;">  
                                    @endif
                                        <div class="d-flex justify-content-center">{{ $comm->name }}</div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                @endcan
            @endif
        </div>
        <div class="col-md-9">
            <div id="app">
                <example-component tickets='{!! json_encode($tickets) !!}'></example-component>
            </div>
        </div>
    </div>
</div>
@endsection