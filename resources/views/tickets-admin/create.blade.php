<div class="modal fade" id="ticketAdminModal" tabindex="-1" role="dialog" aria-labelledby="ticketAdminModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketAdminModal">Ajouter un ticket administratif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/ticket-admin/{{ $user->id }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-10 offset-1">
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
                            <div class="form-group row pt-2 align-items-center">
                                <label for="dépôt" class="col-md-2">Dépôt</label>

                                <input id="dépôt" type="radio" class="col-md-2 @error('dépôt') is-invalid @enderror" name="type" value="dépôt" autocomplete="dépôt" checked>

                                @error('dépôt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label for="retrait" class="col-md-2">Retrait</label>

                                <input id="retrait" type="radio" class="col-md-2 @error('retrait') is-invalid @enderror" name="type" value="retrait" autocomplete="retrait">

                                @error('retrait')
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
        </div>
    </div>
</div>
