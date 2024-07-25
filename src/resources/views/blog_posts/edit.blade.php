<x-app-layout>
    <x-slot name="page_title">{{ __('Edit Blog Post') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Back') }}</a>
                <a href="{{ route('blog_posts.index') }}" class="btn btn-link">{{ __('Post List') }}</a>
                <a href="{{ route('blog_posts.create') }}" class="btn btn-link">{{ __('Add Post') }}</a>
                <a href="{{ route('blog_posts.show', $post->id) }}" class="btn btn-link">{{ __('Show Post') }}</a>
                <a href="{{ route('blog_tags.index') }}" class="btn btn-link">{{ __('Manage Tags') }}</a>
            </x-links-head>

            <div>
                <form method="post" action="{{ route('blog_posts.update', $post->id) }}">
                    @csrf
                    @method('put')

                    {{-- Title --}}
                    <div class="mb-3 row">
                        <x-input-label for="title" class="col-sm-2 col-form-label" :value="__('Title')" />
                        <div class="col-sm-10">
                            <x-input-text type="text" id="title" name="title" :value="old('title', $post->title)" required />
                            <x-input-error :messages="$errors->get('title')" />
                        </div>
                    </div>

                    {{-- Intro --}}
                    <div class="mb-3 row">
                        <x-input-label for="intro" class="col-sm-2 col-form-label" :value="__('Intro')" />
                        <div class="col-sm-10">
                            <textarea name="intro" class="form-control" rows="3" required>{{ old('intro', $post->intro) }}</textarea>
                            <x-input-error :messages="$errors->get('intro')" />
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="mb-3 row">
                        <x-input-label for="content" class="col-sm-2 col-form-label" :value="__('Content')" />
                        <div class="col-sm-10">
                            <textarea name="content" class="form-control" rows="7" required>{{ old('content', $post->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- Published date --}}
                    <div class="mb-3 row">
                        <x-input-label for="published_at" class="col-sm-2 col-form-label" :value="__('Published date')" />
                        <div class="col-sm-10">
                            <x-input-text type="text" id="published_at" name="published_at" class="w-25" :value="old('published_at', $post->published_at)" required />
                            <x-input-error :messages="$errors->get('published_at')" />
                        </div>
                    </div>

                    <!-- Is active? -->
                    <div class="mb-3 row">
                        <x-input-label for="is_active" class="col-sm-2 col-form-label" :value="__('Is active?')" />
                        <div class="col-sm-10">
                            <x-input-checkbox name="is_active" :checked="old('is_active', $post->is_active)" />
                            <x-input-error :messages="$errors->get('is_active')" />
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="mb-3 row">
                        <x-input-label for="tags" class="col-sm-2 col-form-label" :value="__('Tags')" />
                        <div class="col-sm-10">
                            @foreach ($tags as $tag)
                                <span>
                                    <input type="checkbox" class="form-check-input"
                                           name="tags[]"
                                           value="{{ $tag->id }}"
                                           @if ($errors->any())
                                               @checked(collect(old('tags', []))->contains($tag->id))
                                           @else
                                               @checked($post->tags->contains($tag->id))
                                           @endif
                                    >&nbsp;{{ $tag->name }}
                                </span>
                            @endforeach
                            <x-input-error :messages="$errors->get('tags')" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <x-button-primary :value="__('Edit')" />
                    </div>
                </form>
            </div>
        </x-card-general>
    </x-slot>

</x-app-layout>
