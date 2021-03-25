<div class="modal fade" id="listCommModal" tabindex="-1" role="dialog" aria-labelledby="listCommModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listCommModal">Réaffectation de ressources</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="pb-md-3">Veuillez choisir un commercial</h6>
                <form action="/ticket-comm/ressource/{{ $ticket->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="table">
                        @foreach($commerciaux as $comm)
                        @if($comm->color <= '#999999')
                            <tr class="text-light" style="background-color : {{ $comm->color }}">
                        @else
                            <tr class="text-dark" style="background-color : {{ $comm->color }}">
                        @endif
                                <td>{{ $comm->id }}</td>
                                <td>{{ $comm->name }}</td>
                                <td><input type="radio" name="id" value="{{ $comm->id }}"  required></td>
                            </tr>
                        @endforeach
                    </table>
                    <button class="btn btn-primary mt-3">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>