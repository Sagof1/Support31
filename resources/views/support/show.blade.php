@extends('layouts.app')

@section('content')
    <div class="container">
    <a href="{{ route('home', $block->id )}}" class="btn btn-primary">Повернутись</a>
        <h1>{{ $block->title }}</h1>
        <h4>{{ $block->description }}</h4>
        <ul>
            @foreach ($block->sections as $section)
                <li>
                    <a href="{{ route('faq.section', ['block' => $block->id, 'section' => $section->id]) }}">{{ $section->title }}</a>
                </li>
            @endforeach
        </ul>
        @if(Auth::check())
            <?php $user = Auth::user(); ?>
            @if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
                <form action="{{ route('faq.edit', $block->id) }}" method="GET" class="d-inline">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-primary">Редагувати</button>
                </form>
            @endif
        @endif
    </div>
@endsection