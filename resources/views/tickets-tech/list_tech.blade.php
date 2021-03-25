<div class="modal fade" id="listTechModal" tabindex="-1" role="dialog" aria-labelledby="listTechModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listTechModal">Réaffectation de ressources</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="pb-md-3">Veuillez choisir un technicien</h6>
                <form action="/ticket-tech/ressource/{{ $ticket->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="table">
                        @foreach($techniciens as $tech)
                        @if($tech->color <= '#999999')
                            <tr class="text-light" style="background-color : {{ $tech->color }}">
                        @else
                            <tr class="text-dark" style="background-color : {{ $tech->color }}">
                        @endif
                                <td>{{ $tech->id }}</td>
                                <td>{{ $tech->name }}</td>
                                <td><input type="radio" name="id" value="{{ $tech->id }}" required></td>
                            </tr>
                        @endforeach
                    </table>
                    <button class="btn btn-primary mt-3">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>