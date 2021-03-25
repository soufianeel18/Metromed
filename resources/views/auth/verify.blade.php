@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vérification d'adresse E-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un lien de vérification est envoyé à votre adresse email.
                        </div>
                    @endif

                    Avant de continuer, veuillez consulter le lien de vérification de votre adresse email,
                    Si vous n'avez rien reçu,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Cliquer ici pour envoyer un nouveau lien</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
