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
                {{-- LikeDislike Section --}}
                <div>
                    <form method="post" action="{{ route('like_dislike') }}">
                        @csrf
                        <input type="hidden" name="model_id" value="{{ $post->id }}" />
                        <input type="hidden" name="model_type" value="blog_likedislike" />
                        <input type="hidden" name="like" value="0" />
                        <input type="hidden" name="dislike" value="0" />
                        <button type="submit" name="like" value="1" class="btn btn-primary">{{ __('Like (:vote)', ['vote' => $likeDislike['likes']]) }}</button>
                        <button type="submit" name="dislike" value="1" class="btn btn-primary">{{ __('Dislike (:vote)', ['vote' => $likeDislike['dislikes']]) }}</button>
                        <x-input-error :messages="$errors->get('model_id')" />
                        <x-input-error :messages="$errors->get('model_type')" />
                        <x-input-error :messages="$errors->get('like')" />
                        <x-input-error :messages="$errors->get('dislike')" />
                    </form>
                    @if($likeDislike['total_votes'])
                        <span class="fw-lighter">{{ __('Total votes: :vote', ['vote' => $likeDislike['total_votes']]) }}</span>
                    @endif
                </div>
                <a id="comments"></a>
                <hr/>
                {{-- Comments Section --}}
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
                                    <x-input-error :messages="$errors->get('commentable_type')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <input type="hidden" name="commentable_id" value="{{ $post->id }}"/>
                                <input type="hidden" name="commentable_type" value="blog_comment"/>
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
