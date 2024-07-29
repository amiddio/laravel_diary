<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Repositories\BlogRepository;
use App\Repositories\Cabinet\BlogPostRepository;
use App\Repositories\Cabinet\BlogTagRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class BlogPostController extends Controller
{

    public function __construct(
        protected BlogPostRepository $blogPostRepository,
        protected BlogTagRepository $blogTagRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = $this->blogPostRepository->all();
        return view('cabinet.blog_posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tags = $this->blogTagRepository->all();

        return view('cabinet.blog_posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $result = $this->blogPostRepository->create($validated);
        if ($result) {
            self::setAlert(status: 'success', message: __('Blog post created successfully!'));
        }

        return redirect()->route('cabinet.blog_posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = $this->blogPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('view', $post);

        return view('cabinet.blog_posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = $this->blogPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('view', $post);

        $tags = $this->blogTagRepository->all();

        return view('cabinet.blog_posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, string $id): RedirectResponse
    {
        $post = $this->blogPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('update', $post);

        $validated = $request->validated();
        $post = $this->blogPostRepository->update(post: $post, data: $validated);
        if ($post->wasChanged() || $post->getAttribute('is_tags_changed')) {
            self::setAlert(status: 'success', message: __('Blog post edited successfully!'));
        }

        return redirect()->route('cabinet.blog_posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = $this->blogPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('delete', $post);

        if ($this->blogPostRepository->delete($post)) {
            self::setAlert(status: 'success', message: __('Post was deleted!'));
        }
        return redirect()->route('cabinet.blog_posts.index');
    }

//    /**
//     * @param BlogRepository $blogRepository
//     * @return View
//     */
//    public function listPublishedPost(BlogRepository $blogRepository): View
//    {
//        $posts = $blogRepository->all();
//        return view('blog_posts.list_published_post', compact('posts'));
//    }
//
//    public function showPublishedPost(string $user_id, string $slug, BlogRepository $blogRepository): View
//    {
//        $post = $blogRepository->get(user_id: $user_id, slug: $slug);
//        return view('blog_posts.detail', compact('post'));
//    }
}
