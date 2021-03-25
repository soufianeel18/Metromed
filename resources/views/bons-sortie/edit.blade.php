<div class="modal fade" id="bonModal" tabindex="-1" role="dialog" aria-labelledby="bonModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bonModal">Modifier un bon de sortie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/bon-sortie/{{ $bon->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="form-group row">
                                <label for="date" class="col-form-label">Date de sortie</label>

                                <input id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ date('Y-m-d\TH:i:s', strtotime($bon->date)) }}" autocomplete="date" autofocus required>

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="quantite" class="col-form-label">Quantité</label>

                                <input id="quantite" type="number" class="form-control @error('quantite') is-invalid @enderror" name="quantite" value="{{ $bon->quantite }}" autocomplete="quantite" required>

                                @error('quantite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="cname" class="col-form-label">Nom du client</label>

                                <input id="cname" type="text" class="form-control @error('cname') is-invalid @enderror" name="cname" value="{{ $bon->cname }}" autocomplete="cname" required>

                                @error('cname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="cphone" class="col-form-label">Téléphone</label>

                                <input id="cphone" type="text" class="form-control @error('cphone') is-invalid @enderror" name="cphone" value="{{ $bon->cphone }}" autocomplete="cphone" required>

                                @error('cphone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="n_market" class="col-form-label">N° Marché</label>

                                <input id="n_market" type="text" class="form-control @error('n_market') is-invalid @enderror" name="n_market" value="{{ $bon->n_market }}" autocomplete="n_market">

                                @error('n_market')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="ville" class="col-form-label">Ville</label>

                                <input id="ville" type="text" class="form-control @error('ville') is-invalid @enderror" name="ville" value="{{ $bon->ville }}" autocomplete="ville">

                                @error('ville')
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