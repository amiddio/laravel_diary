<x-app-layout>
    <x-slot name="page_title">{{ __('Blog Posts') }}</x-slot>

    <x-slot name="content">
        <x-card-general>

            <x-alert />

            <x-links-head>
                <a href="{{ route('blog_posts.create') }}" class="btn btn-link">{{ __('Add Post') }}</a>
                <a href="{{ route('blog_tags.index') }}" class="btn btn-link">{{ __('Manage Tags') }}</a>
            </x-links-head>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="col-sm-1">#</th>
                    <th scope="col" class="col-sm-4">{{ __('Title') }}</th>
                    <th scope="col" class="col-sm-3">{{ __('Published At') }}</th>
                    <th scope="col" class="col-sm-2">{{ __('Is Active?') }}</th>
                    <th scope="col" class="col-sm-2">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>
                            {{ $post->title }}
                            @if($post->tags->isNotEmpty())
                            <div class="fs-6 fw-lighter">Tags: {{ $post->tags->implode('name', ', ') }}</div>
                            @endif
                        </td>
                        <td>{{ $post->published_at }}</td>
                        <td>
                            @if($post->is_active)
                                {{ __('Yes') }}
                            @else
                                {{ __('No') }}
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-link" href="{{ route('blog_posts.edit', [$post->id]) }}">{{ __('Edit') }}</a>

                            <x-modal :id="'post-'.$post->id" :title="__('Delete post')" :submit_text="__('Delete')">
                                <form method="post" action="{{ route('blog_posts.destroy', $post->id) }}" id="post-{{ $post->id }}-form">
                                    @csrf
                                    @method('delete')
                                    <p>
                                        {{ __('Are you sure you want to delete post \':post\'?', ['post' => $post->title]) }}
                                    </p>
                                </form>
                            </x-modal>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#post-{{ $post->id }}">
                                {{ __('Delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </x-card-general>
    </x-slot>

</x-app-layout>
