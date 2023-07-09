@extends('layouts.app')

@section('content')
@if(Auth::check())
<?php $user = Auth::user(); ?>
@if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
    <div class="container">
    <a href="{{ route('faq.section', ['block' => $block->id, 'section' => $section->id] )}}" class="btn btn-primary">Повернутись</a>
        <h1>Редагування підрозділу</h1>
        <form action="{{ route('faq.section.update', ['block' => $section->faq_block_id, 'section' => $section->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $section->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Зміст</label>
                <textarea name="content" id="content" class="form-control" rows="4" required>{{ $section->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Оновити</button>
        </form>
        <form action="{{ route('faq.section.delete', ['block' => $section->faq_block_id, 'section' => $section->id]) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this section?')">Видалити</button>
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
        plugins: 'advlist autolink lists link charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
    });
</script>
@endsection