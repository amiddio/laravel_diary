<x-app-layout>
    <x-slot name="page_title">{{ __('Edit Category') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Back') }}</a>
                <a href="{{ route('cabinet.categories.index') }}" class="btn btn-link">{{ __('Category List') }}</a>
                <a href="{{ route('cabinet.categories.create') }}" class="btn btn-link">{{ __('Add Category') }}</a>
            </x-links-head>

            <div class="w-50">
                <form method="post" action="{{ route('cabinet.categories.update', [$category->id]) }}">
                    @csrf
                    @method('put')

                    <!-- Name -->
                    <div class="mb-3 row">
                        <x-input-label for="name" class="col-sm-4 col-form-label" :value="__('Name')" />
                        <div class="col-sm-8">
                            <x-input-text type="text" id="name" name="name" :value="old('name', $category->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                    </div>

                    <!-- Is active? -->
                    <div class="mb-3 row">
                        <x-input-label for="is_active" class="col-sm-4 col-form-label" :value="__('Is active?')" />
                        <div class="col-sm-8">
                            <x-input-checkbox name="is_active" :checked="old('is_active', $category->is_active)" />
                            <x-input-error :messages="$errors->get('is_active')" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <x-button-primary :value="__('Update')" />
                    </div>
                </form>
            </div>
        </x-card-general>
    </x-slot>

</x-app-layout>
