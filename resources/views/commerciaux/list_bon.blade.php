<div class="modal fade" id="listBonModal" tabindex="-1" role="dialog" aria-labelledby="listBonModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listBonModal">Ajouter un ticket commercial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="pb-md-3">Veuillez choisir un client</h6>
                <table class="table">
                    @foreach($clientsBon as $client)
                    <tr>
                        <td style="cursor: pointer">
                            <a href="/commercial/{{ $user->id }}/client/{{ $client->id }}/ticket-comm/create" class="text-dark" style="text-decoration: none;">
                                <div class="d-flex justify-content-center">{{ $client->id }}</div>
                            </a>
                        </td>
                        <td style="cursor: pointer">
                            <a href="/commercial/{{ $user->id }}/client/{{ $client->id }}/ticket-comm/create" class="text-dark" style="text-decoration: none;">
                                <div class="d-flex justify-content-center">{{ $client->name }}</div>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <a href="/client-bon-de-commande" class="text-blue font-weight-bold">Plus de détails...</a>
            </div>
        </div>
    </div>
</div>