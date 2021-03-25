<div class="modal fade" id="commEvent{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="commEvent{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commEvent{{ $comment->id }}">Historique de modifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="row">
					<div class="col-10 offset-1">
						@foreach(collect($comment->commEvents)->sortBy('date') as $event)
							<span><strong>{{ $event->label }}</strong></span><br>
							<span class="h6">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y à H\hi') }}</span>
							<p style="white-space: pre-wrap;  overflow-wrap: normal;">{{ $event->text }}</p>
							<hr>
						@endforeach
					</div>
				</div>
            </div>
        </div>
    </div>
</div>