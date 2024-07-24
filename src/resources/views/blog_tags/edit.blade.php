<x-app-layout>
    <x-slot name="page_title">{{ __('Edit Blog Tag') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Back') }}</a>
                <a href="{{ route('blog_tags.index') }}" class="btn btn-link">{{ __('Tag List') }}</a>
                <a href="{{ route('blog_tags.create') }}" class="btn btn-link">{{ __('Add Tag') }}</a>
            </x-links-head>

            <div class="w-50">
                <form method="post" action="{{ route('blog_tags.update', $tag->id) }}">
                    @csrf
                    @method('put')

                    {{-- Name --}}
                    <div class="mb-3 row">
                        <x-input-label for="name" class="col-sm-2 col-form-label" :value="__('Name')" />
                        <div class="col-sm-10">
                            <x-input-text type="text" id="name" name="name" :value="old('name', $tag->name)" required />
                            <x-input-error :messages="$errors->get('name')" />
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
