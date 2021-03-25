<div class="modal fade" id="listMarketModal" tabindex="-1" role="dialog" aria-labelledby="listMarketModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listMarketModal">Ajouter un ticket technique</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="pb-md-3">Veuillez choisir un équipement</h6>
                <table class="table">
                    @foreach($equipementsMarket as $eq)
                        @switch($eq->fonctionnel)
                            @case("oui")
                                <tr class="table-success">
                            @break
                            @case("anomalie")
                                <tr class="table-warning">
                            @break
                            @case("non")
                                <tr class="table-danger">
                            @break
                            @default
                                <tr>
                        @endswitch
                        <td style="cursor: pointer">
                            <a href="/technicien/{{ $user->id }}/equipement/{{ $eq->id }}/ticket-tech/create" class="text-dark" style="text-decoration: none;">
                                <div class="d-flex justify-content-center">{{ $eq->id }}</div>
                            </a>
                        </td>
                        <td style="cursor: pointer">
                            <a href="/technicien/{{ $user->id }}/equipement/{{ $eq->id }}/ticket-tech/create" class="text-dark" style="text-decoration: none;">
                                <div class="d-flex justify-content-center">{{ $eq->designation }}</div>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="d-flex align-items-center">
                    <div class="color-box bg-success rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                    <span style="font-size: 12px;">Fonctionnel</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="color-box bg-warning rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                    <span style="font-size: 12px;">Fonctionnel avec anomalie</span>
                </div>
                <div class="d-flex align-items-center pb-2">
                    <div class="color-box bg-danger rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                    <span style="font-size: 12px;">Non fonctionnel</span>
                </div>
                <a href="/market" class="text-blue font-weight-bold">Plus de détails...</a>
            </div>
        </div>
    </div>
</div>