@extends('layouts.app')

@section('content')
@if(Auth::check())
<?php $user = Auth::user(); ?>
@if($user->access_level == 'Admin' || $user->access_level == 'Senior Agent')
    <div class="container">
        <h2>Контроль прав доступу</h2>
        <hr>

        <div class="row justify-content-center mb-4">
        <div class="col-md-8">
        <form method="GET" action="{{ route('access.search') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Пошук за ім'ям або email">
                <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
        </div>
    </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ім'я</th>
                            <th>Email</th>
                            <th>Рівень доступу</th>
                            <th>Змінити</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->access_level }}</td>
                                <td>
                                    <form action="{{ route('access.update_access_level', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                        @if(Auth::check())
                                        <?php $auser = Auth::user(); ?>
                                        @if($auser->access_level == 'Admin')
                                            <select name="access_level" class="form-control my-2">
                                                <option value="User" {{ ($user->access_level == 'User') ? 'selected' : '' }}>User</option>
                                                <option value="Agent" {{ ($user->access_level == 'Agent') ? 'selected' : '' }}>Agent</option>
                                                <option value="Senior Agent" {{ ($user->access_level == 'Senior Agent') ? 'selected' : '' }}>Senior Agent</option>
                                                <option value="Admin" {{ ($user->access_level == 'Admin') ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        @else
                                            @if($user->access_level == 'Admin' || $user->access_level == 'Senior Agent')

                                            @else
                                            <select name="access_level" class="form-control my-2">
                                                <option value="User" {{ ($user->access_level == 'User') ? 'selected' : '' }}>User</option>
                                                <option value="Agent" {{ ($user->access_level == 'Agent') ? 'selected' : '' }}>Agent</option>
                                            </select>
                                            @endif
                                        @endif
                                        @endif
                                        </div>
                                        @if($auser->access_level == 'Senior Agent')
                                        @if($user->access_level == 'Admin' || $user->access_level == 'Senior Agent')

                                        @else
                                        <button type="submit" class="btn btn-primary">Зберегти</button>
                                        @endif
                                        @else
                                        <button type="submit" class="btn btn-primary">Зберегти</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Користувачів не знайдено</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <h2>Як Ви сюди потрапили?</h2>
@endif
@endif
@endsection