<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Ticket;
use \App\Comment;

class CommentController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function store(Ticket $ticket) {
        $this->authorize('createComment', $ticket, \App\Comment::class);

        $data = request()->validate([
            'text' => 'required',
            'fonctionnel' => '',
        ]);

        if($ticket->client_id == null) {
            if($ticket->equipement_id == null) {
                $comment = $ticket->comments()->create([
                    'user_id' => auth()->user()->id,
                    'text' => $data['text'],
                ]);
                $path = '/ticket-admin/';
            } else {
                $comment = $ticket->comments()->create([
                    'user_id' => auth()->user()->id,
                    'text' => $data['text'],
                    'fonctionnel' => $data['fonctionnel'],
                ]);
                if($data['fonctionnel'] != 'rien') {
                    $comment->ticket->equipement->fonctionnel = $data['fonctionnel'];
                    $comment->ticket->equipement->update();
                }
                $path = '/ticket-tech/';
            }
        } else {
            $comment = $ticket->comments()->create([
                'user_id' => auth()->user()->id,
                'text' => $data['text'],
            ]);
            $path = '/ticket-comm/';
        }

    	return redirect($path . $ticket->id);
    }

    public function update(Comment $comment) {
        $this->authorize('update', $comment);

        $data = request()->validate([
            'text' => 'required',
            'fonctionnel' => '',
        ]);

        if($comment->ticket->client_id == null) {
            if($comment->ticket->equipement_id == null) {
                $comment->text = $data['text'];
                $comment->update();
                $path = '/ticket-admin/';
            } else {
                $comment->update($data);
                if($data['fonctionnel'] != 'rien') {
                    $comment->ticket->equipement->fonctionnel = $data['fonctionnel'];
                    $comment->ticket->equipement->update();
                }
                $path = '/ticket-tech/';
            }
        } else {
            $comment->text = $data['text'];
            $comment->update();
            $path = '/ticket-comm/';
        }

        return redirect($path . $comment->ticket->id);
    }
}
