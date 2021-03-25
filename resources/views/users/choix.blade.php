<div class="modal fade" id="user{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="user{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user{{ $user->id }}">Paramètres utilisateur : {{ $user->username }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @can('update', $user)
                    <div class="row pb-2">
                        <div class="col-12">
                            <button class="btn btn-outline-info pt-3 pb-3" style="width: 100%" onclick="window.location.href='/user/{{ $user->id }}/edit'">Modifier les informations</button>
                        </div>
                    </div>
                @endcan
                @can('update', $user)
                    <div class="row pb-2">
                        <div class="col-12">
                            <button class="btn btn-outline-info pt-3 pb-3" style="width: 100%" onclick="window.location.href='/user/{{ $user->id }}/password/edit'">Changer le mot de passe</button>
                        </div>
                    </div>
                @endcan
                @can('updateRole', $user)
                    <div class="row pb-2">
                        <div class="col-12">
                            <button class="btn btn-outline-info pt-3 pb-3" style="width: 100%" onclick="window.location.href='/user/{{ $user->id }}/role/edit'">Changer le rôle</button>
                        </div>
                    </div>
                @endcan
                @can('delete', $user)
                    <div class="row">
                        <div class="col-12">
                            <form action="/user/{{ $user->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger pt-3 pb-3" style="cursor: pointer; width: 100%">Supprimer {{ $user->username }}</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>