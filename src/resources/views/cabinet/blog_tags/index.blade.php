<x-app-layout>
    <x-slot name="page_title">{{ __('Blog Tags') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-alert />

            <x-links-head>
                <a href="{{ route('cabinet.blog_tags.create') }}" class="btn btn-link">{{ __('Add Tag') }}</a>
            </x-links-head>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="col-sm-1">#</th>
                    <th scope="col" class="col-sm-9">{{ __('Name') }}</th>
                    <th scope="col" class="col-sm-2">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a class="btn btn-link" href="{{ route('cabinet.blog_tags.edit', [$tag->id]) }}">{{ __('Edit') }}</a>

                            <x-modal :id="'tag-'.$tag->id" :title="__('Delete tag')" :submit_text="__('Delete')">
                                <form method="post" action="{{ route('cabinet.blog_tags.destroy', [$tag->id]) }}" id="tag-{{ $tag->id }}-form">
                                    @csrf
                                    @method('delete')
                                    <p>
                                        {{ __('Are you sure you want to delete tag \':tag\'?', ['tag' => $tag->name]) }}
                                    </p>
                                </form>
                            </x-modal>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#tag-{{ $tag->id }}">
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
