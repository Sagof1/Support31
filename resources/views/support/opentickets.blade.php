@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Останні звернення</h1>

        @if (count($tickets) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Створено</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>
                                @if ($ticket->status == 'Open')
                                    <form action="{{ route('ticket.update', $ticket->id) }}" method="PUT">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Взяти звернення</button>
                                    </form>
                                @else
                                    <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-secondary">Перегляд</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Звернень немає</p>
        @endif
    </div>
@endsection