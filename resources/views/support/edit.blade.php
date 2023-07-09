@extends('layouts.app')

@section('content')
@if(Auth::check())
<?php $user = Auth::user(); ?>
@if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
    <div class="container">
        <a href="{{ route('faq.show', $block->id )}}" class="btn btn-primary">Повернутись</a>
        <h1>Редагування розділу</h1>
        <form action="{{ route('faq.update', $block->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control " value="{{ $block->title }}" required>
                <label for="title">Опис</label>
                <input type="text" name="description" id="description" class="form-control my-2" value="{{ $block->description }}" required>
            </div>
            @foreach ($block->sections as $section)
                <li class="my-2">
                    <a href="{{ route('faq.section', ['block' => $block->id, 'section' => $section->id]) }}">{{ $section->title }}</a>
                </li>
            @endforeach
            <button type="submit" class="btn btn-primary my-3">Оновити</button>
            <a href="{{ route('faq.create_section', $block->id) }}" class="btn btn-primary">Створити підрозділ</a>
        </form>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Підтверждення видалення');
        }
    </script>
@else
    <h2>Як Ви сюди потрапили?</h2>
@endif
@endif
@endsection
