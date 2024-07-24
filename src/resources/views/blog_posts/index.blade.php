<x-app-layout>
    <x-slot name="page_title">{{ __('Blog Posts') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-links-head>
                <a href="{{ route('blog_posts.create') }}" class="btn btn-link">{{ __('Add Post') }}</a>
                <a href="{{ route('blog_tags.index') }}" class="btn btn-link">{{ __('Manage Tags') }}</a>
            </x-links-head>

            <div>

            </div>
        </x-card-general>
    </x-slot>

</x-app-layout>
