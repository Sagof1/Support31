<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketAttachment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->message = $request->input('message');
        $comment->user_id = auth()->user()->id;
        $ticket->comments()->save($comment);

        return redirect()->route('support.showticket', $ticket);
    }*/
    public function store(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        $this->validate($request, [
            'message' => 'required',
        ]);

        $comment = new Comments([
            'message' => $request->input('message'),
            'user_id' => auth()->user()->id,
        ]);
        if (auth()->user()->access_level !== 'User') {
            $ticket->support_agent_id = auth()->user()->id;
            $ticket->save();
        }


        $ticket->comments()->save($comment);

        return redirect()->back();
    }

    /*public function show(Ticket $ticket, Comments $comment, User $user)
    {
        $user = Auth::user();
        return view('comments.show', [
            'ticket' => $ticket,
            'comment' => $comment,
            'user' => $user
        ]);
    }*/
    public function show($id, $commentId)
    {
        $comment = Comments::findOrFail($commentId);

        $user = $comment->user;

        return view('comments.show', compact('comment', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
