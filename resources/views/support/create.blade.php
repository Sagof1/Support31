@extends('layouts.app')

@section('content')
@if(Auth::check())
<?php $user = Auth::user(); ?>
@if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
    <div class="container">
    <a href="{{ route('home')}}" class="btn btn-primary">Повернутись</a>
        <h1>Створення розділу</h1>
        <form action="{{ route('faq.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" required>
                <label for="title">Опис</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary my-2">Створити</button>
        </form>
    </div>
@else
<h2>Як Ви сюди потрапили?</h2>
@endif
@endif
@endsection