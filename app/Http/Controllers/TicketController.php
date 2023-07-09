<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comments;
use App\Models\TicketAttachment;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->paginate(10);
        return view('support.mytickets', compact('user', 'tickets'));
    }*/
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $search = $request->get('search');

        if ($search) {
            $tickets = Ticket::where('user_id', $user_id)
                            ->where(function($query) use ($search) {
                                $query->where('subject', 'like', '%'.$search.'%')
                                    ->orWhere('description', 'like', '%'.$search.'%');
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

            return view('support.mytickets', compact('tickets'));
        }

        $tickets = Ticket::where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('support.mytickets', compact('tickets'));
    }
    public function agentIndex(Request $request)
    {
        $user_id = Auth::id();
        $search = $request->get('search');

        if ($search) {
            $tickets = Ticket::where('user_id', $user_id)
                            ->where(function($query) use ($search) {
                                $query->where('subject', 'like', '%'.$search.'%')
                                    ->orWhere('description', 'like', '%'.$search.'%');
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

            return view('support.myanswers', compact('tickets'));
        }

        $tickets = Ticket::where('support_agent_id', $user_id)->orderBy('created_at', 'asc')->paginate(10);
        return view('support.myanswers', compact('tickets'));
    }
    public function answeredIndex(Request $request)
    {
        $user_id = Auth::id();
        $search = $request->get('search');

        if ($search) {
            $tickets = Ticket::whereNotNull('support_agent_id')
                            ->where(function($query) use ($search) {
                                $query->where('subject', 'like', '%'.$search.'%')
                                    ->orWhere('description', 'like', '%'.$search.'%');
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

            return view('support.answeredtickets', compact('tickets'));
        }

        $tickets = Ticket::whereNotNull('support_agent_id')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('support.answeredtickets', compact('tickets'));
    }
    /*
    public function agentIndex()
    {
        $user = Auth::user();
        $tickets = Ticket::where('support_agent_id', $user->id)->orderBy('created_at', 'asc')->paginate(10);
        return view('support.myanswers', compact('tickets'));
    }*/

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
    public function store(Request $request)
    {
        $ticket = Ticket::create([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'status' => 'Open', // set default status to "Open"
            'user_id' => auth()->user()->id, // set the user_id to the currently authenticated user
        ]);
        return redirect()->route('ticket.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $user = Auth::user();
        $ticket = Ticket::findOrFail($ticket_id);
        $comments = $ticket->comments()->with('user')->latest()->get();
        return view('support.showticket', compact('ticket', 'comments', 'user'));
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
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->status = 'In Progress';
        $ticket->save();

        return redirect()->route('ticket.show', $ticket->id);
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
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'status' => ['required', Rule::in(['Open', 'In Progress', 'Closed'])],
        ]);

        $ticket->status = $validatedData['status'];
        $ticket->save();

        return redirect()->back();
    }
    public function search(Request $request)
    {
        $user_id = Auth::id();
        $search = $request->get('search');

        $tickets = Ticket::where('user_id', $user_id)
                        ->where(function($query) use ($search) {
                            $query->where('subject', 'like', '%'.$search.'%')
                                ->orWhere('description', 'like', '%'.$search.'%');
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('myticket.index', compact('tickets'));
    }
}
