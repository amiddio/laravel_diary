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
                <hr/>
                <div class="w-50">
                    <h5>{{ __('Comments') }}</h5>
                    <div>
                        @foreach($comments as $comment)
                            <div class="card my-2">
                                <div class="card-body">
                                    <div class="fw-lighter">
                                        {{ __('Author') }}: {{ $comment->user->name }} ({{ $comment->published_at_formated }})
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $comments->links() }}
                    <div>
                    @auth
                        <form method="post" action="{{ route('comment.store') }}">
                            @csrf

                            {{-- Message --}}
                            <div class="mb-3 row">
                                <x-input-label for="content" class="col-sm-2 col-form-label" :value="__('Message')" />
                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control" rows="3" required>{{ old('content') }}</textarea>
                                    <x-input-error :messages="$errors->get('content')" />
                                    <x-input-error :messages="$errors->get('commentable_id')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <input type="hidden" name="commentable_id" value="{{ $post->id }}"/>
                                <x-button-primary :value="__('Send')" />
                            </div>
                        </form>
                    @else
                        <a href="{{ route('login') }}">{{ __('Leave a comment') }}</a>
                    @endauth
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

</x-main-layout>
