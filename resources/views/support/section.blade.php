@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('faq.show', $block->id )}}" class="btn btn-primary">Повернутись</a>
        <h1>{{ $section->title }}</h1>
        <p>{!! $section->content !!}</p>
        @if(Auth::check())
        <?php $user = Auth::user(); ?>
        @if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
         <a href="{{ route('faq.section.edit', ['block' => $section->faq_block_id, 'section' => $section->id]) }}" class="btn btn-primary">Редагувати</a>
        @endif
        @endif
    </div>
@endsection