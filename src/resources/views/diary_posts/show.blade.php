<x-app-layout>
    <x-slot name="page_title">{{ $post->title }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Back') }}</a>
                <a href="{{ route('diary_posts.index') }}" class="btn btn-link">{{ __('Post List') }}</a>
                <a href="{{ route('diary_posts.create') }}" class="btn btn-link">{{ __('Add New Post') }}</a>
                <a href="{{ route('diary_posts.edit', $post->id) }}" class="btn btn-link">{{ __('Edit Post') }}</a>
            </x-links-head>

            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{!! nl2br($post->content) !!}</p>
                    @isset($post->category)
                        <p class="text-muted">{{ $post->category->name }}</p>
                    @endisset
                    <p class="fw-lighter">{{ $post->published_at_formated }}</p>
                </div>
            </div>
        </x-card-general>
    </x-slot>

</x-app-layout>
