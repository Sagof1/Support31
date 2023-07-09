@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Найпоширеніші запитання</h1>

        <div class="row">
            @foreach ($blocks as $block)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{ $block->title }}</h4>
                            <p class="card-text">{{ $block->description }}</p>
                            <a href="{{ route('faq.show', $block->id )}}" class="btn btn-primary">Переглянути</a>
                        </div>
                            @if(Auth::check())
                                <?php $user = Auth::user(); ?>
                                    @if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
                                        <div class="card-footer">
                                            <form action="{{ route('faq.destroy', $block->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning" onclick="return confirmDelete();">Видалити</button>
                                            </form>
                                            <form action="{{ route('faq.edit', $block->id) }}" method="GET" class="d-inline">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-primary">Редагувати</button>
                                            </form>
                                        </div>
                                    @endif
                            @endif            
                    </div>
                </div>
            @endforeach
        </div>
        @if(Auth::check())
        <?php $user = Auth::user(); ?>
        @if($user->access_level == 'Admin' || $user->access_level == "Senior Agent")
            <a href="{{ route('faq.create') }}" class="btn btn-primary">Створити розділ</a>
        @endif
        @endif
    </div>
    <script>
        function confirmDelete() {
            return confirm('Підтверждення видалення');
        }
    </script>
@endsection
