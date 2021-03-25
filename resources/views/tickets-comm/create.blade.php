@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/ticket-comm/{{ $user->id }}/{{ $client->id }}" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Ajouter un ticket commercial</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Titre</label>

                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus required>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="start_date" class="col-md-4 col-form-label">Date du début</label>

                    <input id="start_date" type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" autocomplete="start_date" autofocus required>

                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="end_date" class="col-md-4 col-form-label">Date de fin</label>

                    <input id="end_date" type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" autocomplete="end_date" autofocus required>

                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="commentary" class="col-md-4 col-form-label">Commentaire</label>

                    <textarea id="commentary" class="form-control @error('commentary') is-invalid @enderror" name="commentary" autocomplete="commentary" required></textarea>

                    @error('commentary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row pt-2">
                    <button class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
