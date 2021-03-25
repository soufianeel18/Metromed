@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/user" method="post">
    @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row pb-2">
                    <h1>Ajouter un utilisateur</h1>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4">Nom</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4">Adresse E-mail</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4">Téléphone</label>

                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="username" class="col-md-4">Nom d'utilisateur</label>

                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username">

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4">Mot de passe</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4">Confirmez le mot de passe</label>

                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation">
                </div>
                <input id="guest" type="radio" class="col-md-1 @error('guest') is-invalid @enderror" name="role" value="guest" autocomplete="guest" checked hidden>
                @if(Auth::User()->role == 'admin' || Auth::User()->role == 'chef technicien')
                    <div class="form-group row pt-2 align-items-center">
                        <label for="technicien" class="col-md-4">Technicien</label>

                        <input id="technicien" type="radio" class="col-md-1 @error('technicien') is-invalid @enderror" name="role" value="technicien" autocomplete="technicien">

                        <label for="chef technicien" class="col-md-4">Chef des techniciens</label>

                        <input id="chef technicien" type="radio" class="col-md-1 @error('chef technicien') is-invalid @enderror" name="role" value="chef technicien" autocomplete="chef technicien">
                    </div>
                @endif
                @if(Auth::User()->role == 'admin' || Auth::User()->role == 'chef commercial')
                    <div class="form-group row pt-2 align-items-center">
                        <label for="commercial" class="col-md-4">Commercial</label>

                        <input id="commercial" type="radio" class="col-md-1 @error('commercial') is-invalid @enderror" name="role" value="commercial" autocomplete="commercial">

                        <label for="chef commercial" class="col-md-4">Chef des commerciaux</label>

                        <input id="chef commercial" type="radio" class="col-md-1 @error('chef commercial') is-invalid @enderror" name="role" value="chef commercial" autocomplete="chef commercial">
                    </div>
                @endif
                @if(Auth::User()->role == 'admin' || Auth::User()->role == 'chef stock')
                    <div class="form-group row pt-2 align-items-center">
                        <label for="agent stock" class="col-md-4">Agent du stock</label>

                        <input id="agent stock" type="radio" class="col-md-1 @error('agent stock') is-invalid @enderror" name="role" value="agent stock" autocomplete="agent stock">

                        <label for="chef stock" class="col-md-4">Chef du stock</label>

                        <input id="chef stock" type="radio" class="col-md-1 @error('chef stock') is-invalid @enderror" name="role" value="chef stock" autocomplete="chef stock">
                    </div>
                @endif
                @if(Auth::User()->role == 'admin')
                    <div class="form-group row pt-2 align-items-center">
                        <label for="admin" class="col-md-4">Administrateur</label>

                        <input id="admin" type="radio" class="col-md-1 @error('admin') is-invalid @enderror" name="role" value="admin" autocomplete="admin">
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-6">
                        <button class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
