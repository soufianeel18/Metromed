@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <h1>Bienvenue {{ Auth::User()->username }} !</h1>
    </div>
</div>
@endsection