<x-app-2-columns-layout>
    <x-slot name="page_title">{{ __('Diary Posts') }}</x-slot>

    <x-slot name="content_left">
        <ul>
        @foreach($categories as $key => $val)
            <li>
                <a href="{{ route('diary_posts.filtered', $val['slug']) }}">{{ $val['name'] }}</a>
            </li>
        @endforeach
        </ul>
        <a href="{{ route('diary_posts.index') }}" class="btn btn-link">{{ __('All') }}</a>
        <hr/>
        <a href="{{ route('categories.index') }}" class="btn btn-link">{{ __('Manage Category') }}</a>
    </x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-alert />

            <x-links-head>
                <a href="{{ route('diary_posts.create') }}" class="btn btn-link">{{ __('Add Post') }}</a>
            </x-links-head>

            <div>
                @foreach($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            @isset($post->category)
                            <p class="text-muted">{{ $post->category->name }}</p>
                            @endisset
                            <p class="card-text">{{ $post->intro }}</p>
                            <p class="fw-lighter">{{ $post->published_at_formated }}</p>
                            @unless($post->intro == $post->content)
                            <a href="{{ route('diary_posts.show', [$post->id]) }}" class="card-link">{{ __('Read More') }}</a>
                            @endunless
                            <a href="{{ route('diary_posts.edit', [$post->id]) }}" class="card-link">{{ __('Edit') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}

        </x-card-general>
    </x-slot>

</x-app-2-columns-layout>
