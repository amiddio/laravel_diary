<x-main-layout>
    <x-slot name="page_title">{{ __('Blog Posts') }}</x-slot>

    <x-slot name="content">

        <div>
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', [$post->user_id, $post->slug]) }}">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text">{{ $post->intro }}</p>
                        <p class="fw-lighter">{{ $post->published_at_formated }}</p>
                        <p class="fw-lighter">
                            <div>{{ __('Author') }}: {{ $post->user->name }}</div>
                            <div>
                                {{ __('Tags') }}:
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blog.index', $tag->name) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            @if($post->comments_count)
                            <div>{{ __('Comments:') }} <a href="{{ route('blog.show', [$post->user_id, $post->slug]) }}#comments">{{ $post->comments_count }}</a></div>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}

    </x-slot>

</x-main-layout>
