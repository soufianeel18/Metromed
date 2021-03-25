@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/user/{{ $user->id }}/password" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Modifier le mot de passe</h1>
                </div>
                <div class="form-group row">
                    <label for="old_password" class="col-md-4 col-form-label">Ancien mot de passe</label>

                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="old_password" autofocus required>

                    @error('old_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label">Nouveau mot de passe</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" required>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label">Confirmez le mot de passe</label>

                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation" required>

                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
