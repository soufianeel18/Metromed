<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModal">Modifier un ticket administratif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/ticket-admin/{{ $ticket->id }}" method="post">
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
                                <label for="dépôt" class="col-md-2">Dépôt</label>

                                @if($ticket->type == 'dépôt')
                                    <input id="dépôt" type="radio" class="col-md-2 @error('dépôt') is-invalid @enderror" name="type" value="dépôt" autocomplete="dépôt" checked>
                                @else
                                    <input id="dépôt" type="radio" class="col-md-2 @error('dépôt') is-invalid @enderror" name="type" value="dépôt" autocomplete="dépôt">
                                @endif

                                @error('dépôt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="retrait" class="col-md-2">Retrait</label>

                                @if($ticket->type == 'retrait')
                                    <input id="retrait" type="radio" class="col-md-2 @error('retrait') is-invalid @enderror" name="type" value="retrait" autocomplete="retrait" checked>
                                @else
                                    <input id="retrait" type="radio" class="col-md-2 @error('retrait') is-invalid @enderror" name="type" value="retrait" autocomplete="retrait">
                                @endif

                                @error('retrait')
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