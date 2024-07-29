<x-main-layout>
    <x-slot name="page_title">{{ $post->title }}</x-slot>

    <x-slot name="content">

        <div class="card mb-3">
            <div class="card-body">
                <p>{{ __('Author') }}: {{ $post->user->name }}</p>
                @if($post->tags->isNotEmpty())
                    <p class="fs-6 fw-lighter">Tags: {{ $post->tags->implode('name', ', ') }}</p>
                @endif
                <p class="fw-lighter">{{ $post->published_at_formated }}</p>
                <hr/>
                <p class="card-text">{!! nl2br($post->content) !!}</p>
            </div>
        </div>

    </x-slot>

</x-main-layout>
