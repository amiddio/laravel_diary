<x-app-layout>
    <x-slot name="page_title">{{ __('Category List') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-alert />

            <x-links-head>
                <a href="{{ route('cabinet.categories.create') }}" class="btn btn-link">{{ __('Add Category') }}</a>
            </x-links-head>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Is active?') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->is_active)
                            {{ __('Yes') }}
                        @else
                            {{ __('No') }}
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-link" href="{{ route('cabinet.categories.edit', [$category->id]) }}">{{ __('Edit') }}</a>

                        <x-modal :id="'cat-'.$category->id" :title="__('Delete category')" :submit_text="__('Delete')">
                            <form method="post" action="{{ route('cabinet.categories.destroy', [$category->id]) }}" id="cat-{{ $category->id }}-form">
                                @csrf
                                @method('delete')
                                <p>
                                    {{ __('Are you sure you want to delete category \':cat\'?', ['cat' => $category->name]) }}
                                </p>
                            </form>
                        </x-modal>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#cat-{{ $category->id }}">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </x-card-general>
    </x-slot>

</x-app-layout>
