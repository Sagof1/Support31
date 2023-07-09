@extends('layouts.app')

@section('content')
@if(Auth::check())
<?php $user = Auth::user(); ?>
@if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
    <div class="container">
    <a href="{{ route('faq.show', $block->id )}}" class="btn btn-primary">Повернутись</a>
        <h1>Створення підрозділу</h1> 
        <form action="{{ route('faq.section.add', $block->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Зміст</label>
                <textarea name="content" id="content" rows="5" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary my-2">Створити</button>
        </form>
    </div>
@else
<h2>Як Ви сюди потрапили?</h2>
@endif
@endif

<script>
    tinymce.init({
        selector: '#content',
        height: 300,
        plugins: 'advlist autolink lists link image imagetools charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        image_caption: true,
        image_title: true
    });
</script>
@endsection
