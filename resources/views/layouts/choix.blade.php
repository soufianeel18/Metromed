<div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="settings" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settings">Paramètres utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @can('update', Auth::User())
                    <div class="row pb-2">
                        <div class="col-12">
                            <button class="btn btn-outline-info pt-3 pb-3" style="width: 100%" onclick="window.location.href='/user/{{ Auth::User()->id }}/edit'">Modifier mes informations</button>
                        </div>
                    </div>
                @endcan
                @can('update', Auth::User())
                    <div class="row pb-2">
                        <div class="col-12">
                            <button class="btn btn-outline-info pt-3 pb-3" style="width: 100%" onclick="window.location.href='/user/{{ Auth::User()->id }}/password/edit'">Changer mon mot de passe</button>
                        </div>
                    </div>
                @endcan
                @can('delete', Auth::User())
                    <div class="row">
                        <div class="col-12">
                            <form action="/user/{{ Auth::User()->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger pt-3 pb-3" style="cursor: pointer; width: 100%">Supprimer mon compte</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>