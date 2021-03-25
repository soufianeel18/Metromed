@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 pt-md-1 pb-3">
            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary" onclick="window.location.href='/user'" style="width: 100%">Gérer les utilisateurs</button>
            </div>
            <hr>
            @if($techniciens->count() != 0)
                <h4 class="pb-md-3">Techniciens</h4>
                <table class="table">
                    @foreach($techniciens as $tech)
                        <tr style="background-color : {{ $tech->color }}">
                            <td style="cursor: pointer">
                                @if($tech->color <= '#aaaaaa')
                                    <a href="/technicien/{{ $tech->id }}" class="text-light" style="text-decoration: none;">  
                                @else
                                    <a href="/technicien/{{ $tech->id }}" class="text-dark" style="text-decoration: none;">  
                                @endif 
                                    <div class="d-flex justify-content-center">{{ $tech->name }}</div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <hr> 
            @endif
            @if($commerciaux->count() != 0)
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