@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $ticket->subject }}</div>

                    <div class="card-body">
                        <p>{{ $ticket->body }}</p>

                        @if ($ticket->status === 'Open')
                            <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Open">{{ __('Open') }}</option>
                                        <option value="In Progress">{{ __('In Progress') }}</option>
                                        <option value="Closed">{{ __('Closed') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="response">{{ __('Response') }}</label>
                                    <textarea name="response" id="response" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </form>
                        @else
                            <div class="alert alert-info">{{ __('This ticket is already closed.') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
access.edit.blade.php:

html
Copy code
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User Access Level') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('access.update', $user) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="access_level">{{ __('Access Level') }}</label>
                                <select name="access




