@extends('layouts.app')

@section('content')
@if(Auth::check())
<?php $user = Auth::user(); ?>
@if($user->access_level == 'Admin' || $user->access_level == "Senior Agent" || $user->access_level == "Agent" || $ticket->user_id == $user->id)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Заголовок: {{ $ticket->subject }}</div>

                    <div class="card-body">
                        <p>Опис: {{ $ticket->description }}</p>
                        <p>Статус: {{ $ticket->status }}</p>
                        <div class="comments">
                            <ul class="list-group">
                                @foreach ($ticket->comments as $comment)
                                    <li class="list-group-item">
                                        
                                        <div class="card-header">{{ $comment->user->name }}</div>
                                        <div class="card-body">{{ $comment->message }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <hr>

                        <div class="comment-form">
                            <form action="{{ route('comments.store', $ticket->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="form-group py-2">
                                    <label for="message">Повідомлення:</label>
                                    <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Відправити</button>
                            </form>
                        </div>
                        <div>
                            @if($user->access_level == 'Admin' or $user->access_level == 'Senior agent' or $user->access_level == 'Agent')
                                <form method="POST" action="{{ route('ticket.updateStatus', $ticket) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="Open"{{ $ticket->status === 'Open' ? ' selected' : '' }}>Open</option>
                                            <option value="In Progress"{{ $ticket->status === 'In Progress' ? ' selected' : '' }}>In Progress</option>
                                            <option value="Closed"{{ $ticket->status === 'Closed' ? ' selected' : '' }}>Closed</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary my-2">Змінити статус</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<h2>Як Ви сюди потрапили?</h2>
@endif
@endif
@endsection