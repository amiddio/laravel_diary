<x-app-layout>
    <x-slot name="page_title">{{ __('Edit Diary Post') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Back') }}</a>
                <a href="{{ route('diary_posts.index') }}" class="btn btn-link">{{ __('Post List') }}</a>
                <a href="{{ route('diary_posts.create') }}" class="btn btn-link">{{ __('Add New Post') }}</a>
                <a href="{{ route('diary_posts.show', $post->id) }}" class="btn btn-link">{{ __('View Post') }}</a>
                <x-modal :id="'post-'.$post->id" :title="__('Delete post')" :submit_text="__('Delete')">
                    <form method="post" action="{{ route('diary_posts.destroy', [$post->id]) }}" id="post-{{ $post->id }}-form">
                        @csrf
                        @method('delete')
                        <p class="text-start">
                            {{ __('Are you sure you want to delete post \':post\'?', ['post' => $post->title]) }}
                        </p>
                    </form>
                </x-modal>
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#post-{{ $post->id }}">
                    {{ __('Delete') }}
                </button>
            </x-links-head>

            <div>
                <form method="post" action="{{ route('diary_posts.update', $post->id) }}">
                    @csrf
                    @method('put')

                    {{-- Category --}}
                    <div class="mb-3 row">
                        <x-input-label for="category_id" class="col-sm-2 col-form-label" :value="__('Category')" />
                        <div class="col-sm-10">
                            <select name="category_id" class="form-select" autofocus>
                                <option value="">---</option>
                                @foreach($categories as $key => $val)
                                    <option value="{{ $key }}" @if(old('category_id', $post->category_id) == $key) selected @endif>{{ $val['name'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" />
                        </div>
                    </div>

                    {{-- Title --}}
                    <div class="mb-3 row">
                        <x-input-label for="title" class="col-sm-2 col-form-label" :value="__('Title')" />
                        <div class="col-sm-10">
                            <x-input-text type="text" id="title" name="title" :value="old('title', $post->title)" required />
                            <x-input-error :messages="$errors->get('title')" />
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

                    <div class="mb-3 row">
                        <x-button-primary :value="__('Edit')" />
                    </div>
                </form>
            </div>
        </x-card-general>
    </x-slot>

</x-app-layout>
