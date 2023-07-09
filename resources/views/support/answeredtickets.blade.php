@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="{{ route('answeredIndex') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Пошук">
                    
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-search">Пошук</span>
                        </button>
                    
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <h1>Відповіді агентів</h1>
        <hr>
        @if ($tickets->count() > 0)
            <div class="card-deck">
                @foreach ($tickets as $ticket)
                    @if ($ticket->support_agent_id != null)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ticket->subject }}</h5>
                                <p class="card-text">Статус: {{ $ticket->status }}</p>
                                <p class="card-text"><small class="text-muted">{{ $ticket->created_at->diffForHumans() }}</small></p>
                                <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-primary">Переглянути</a>
                            </div>
                        </div>
                    @endif    
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $tickets->links() }}
            </div>
        @else
            <p>У агентів не має відповідей.</p>
            <a href="{{ route('new') }}" class="btn btn-primary">Бажаєте створити нове?</a>
        @endif
    </div>
@endsection