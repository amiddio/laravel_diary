<x-app-layout>
    <x-slot name="page_title">{{ __('Create Blog Tag') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Back') }}</a>
                <a href="{{ route('blog_tags.index') }}" class="btn btn-link">{{ __('Tag List') }}</a>
            </x-links-head>

            <div class="w-50">
                <form method="post" action="{{ route('blog_tags.store') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3 row">
                        <x-input-label for="name" class="col-sm-2 col-form-label" :value="__('Name')" />
                        <div class="col-sm-10">
                            <x-input-text type="text" id="name" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <x-button-primary :value="__('Create')" />
                    </div>
                </form>
            </div>
        </x-card-general>
    </x-slot>

</x-app-layout>
