<div class="modal fade" id="comment{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="comment{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comment{{ $comment->id }}">Modifier un commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="commentForm" action="/comment/{{ $comment->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="form-group row">
                                <label for="text" class="col-form-label"><strong>{{ $comment->user->username }} :</strong></label>
                                <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror" autocomplete="text" autofocus required>{{ $comment->text }}</textarea>

                                @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if($comment->fonctionnel != null)
                                <div class="form-group row pt-2 align-items-center">
                                    <label for="oui" class="col-md-8">Fonctionnel</label>

                                    @if($comment->fonctionnel == 'oui')                                
                                        <input id="oui" type="radio" class="col-md-2 @error('oui') is-invalid @enderror" name="fonctionnel" value="oui" autocomplete="oui" autofocus checked>
                                    @else
                                        <input id="oui" type="radio" class="col-md-2 @error('oui') is-invalid @enderror" name="fonctionnel" value="oui" autocomplete="oui" autofocus>
                                    @endif

                                    @error('oui')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="anomalie" class="col-md-8">Anomalie</label>

                                    @if($comment->fonctionnel == 'anomalie')
                                        <input id="anomalie" type="radio" class="col-md-2 @error('anomalie') is-invalid @enderror" name="fonctionnel" value="anomalie" autocomplete="anomalie" autofocus checked>
                                    @else
                                        <input id="anomalie" type="radio" class="col-md-2 @error('anomalie') is-invalid @enderror" name="fonctionnel" value="anomalie" autocomplete="anomalie" autofocus>
                                    @endif

                                    @error('anomalie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="non" class="col-md-8">Non fonctionnel</label>

                                    @if($comment->fonctionnel == 'non')
                                        <input id="non" type="radio" class="col-md-2 @error('non') is-invalid @enderror" name="fonctionnel" value="non" autocomplete="non" autofocus checked>
                                    @else
                                        <input id="non" type="radio" class="col-md-2 @error('non') is-invalid @enderror" name="fonctionnel" value="non" autocomplete="non" autofocus>
                                    @endif
                                    
                                    @error('non')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="rien" class="col-md-8">Pas de réponse</label>

                                    @if($comment->fonctionnel == 'rien')
                                        <input id="rien" type="radio" class="col-md-2 @error('rien') is-invalid @enderror" name="fonctionnel" value="rien" autocomplete="rien" autofocus checked>
                                    @else
                                        <input id="rien" type="radio" class="col-md-2 @error('rien') is-invalid @enderror" name="fonctionnel" value="rien" autocomplete="rien" autofocus>
                                    @endif
                                    
                                    @error('rien')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="row pt-4">
                                <button class="btn btn-primary">Valider</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>