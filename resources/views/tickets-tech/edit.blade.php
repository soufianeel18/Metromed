<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModal">Modifier un ticket technique</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/ticket-tech/{{ $ticket->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="form-group row">
                                <label for="title" class="col-form-label">Titre</label>

                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $ticket->title }}" autocomplete="title" autofocus required>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="start_date" class="col-form-label">Date du début</label>

                                <input id="start_date" type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ date('Y-m-d\TH:i:s', strtotime($ticket->start_date)) }}" autocomplete="start_date" autofocus required>

                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="end_date" class="col-form-label">Date de fin</label>

                                <input id="end_date" type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ date('Y-m-d\TH:i:s', strtotime($ticket->end_date)) }}" autocomplete="end_date" autofocus required>

                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row pt-2 align-items-center">
                                <label for="préventif" class="col-md-8">Préventif</label>

                                @if($ticket->type == 'préventif')
                                    <input id="préventif" type="radio" class="col-md-2 @error('préventif') is-invalid @enderror" name="type" value="préventif" autocomplete="préventif" autofocus checked>
                                @else
                                    <input id="préventif" type="radio" class="col-md-2 @error('préventif') is-invalid @enderror" name="type" value="préventif" autocomplete="préventif" autofocus>
                                @endif

                                @error('préventif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="correctif" class="col-md-8">Correctif</label>

                                @if($ticket->type == 'correctif')
                                    <input id="correctif" type="radio" class="col-md-2 @error('correctif') is-invalid @enderror" name="type" value="correctif" autocomplete="correctif" autofocus checked>
                                @else
                                    <input id="correctif" type="radio" class="col-md-2 @error('correctif') is-invalid @enderror" name="type" value="correctif" autocomplete="correctif" autofocus>
                                @endif

                                @error('correctif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="livraison" class="col-md-8">Livraison</label>

                                @if($ticket->type == 'livraison')
                                    <input id="livraison" type="radio" class="col-md-2 @error('livraison') is-invalid @enderror" name="type" value="livraison" autocomplete="livraison" autofocus checked>
                                @else
                                    <input id="livraison" type="radio" class="col-md-2 @error('livraison') is-invalid @enderror" name="type" value="livraison" autocomplete="livraison" autofocus>
                                @endif

                                @error('livraison')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row align-items-center">
                                <label for="décharge" class="col-md-8">Décharge</label>

                                @if($ticket->type == 'décharge')
                                    <input id="décharge" type="radio" class="col-md-2 @error('décharge') is-invalid @enderror" name="type" value="décharge" autocomplete="décharge" autofocus checked>
                                @else
                                    <input id="décharge" type="radio" class="col-md-2 @error('décharge') is-invalid @enderror" name="type" value="décharge" autocomplete="décharge" autofocus>
                                @endif

                                @error('décharge')
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
        </div>
    </div>
</div>