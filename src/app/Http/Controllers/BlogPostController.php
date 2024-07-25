<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogTagRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        return view('blog_posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tags = $this->blogTagRepository->all();
        return view('blog_posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->blogPostRepository->create($validated);
        return redirect()->route('blog_posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = $this->blogPostRepository->find($id);
        return view('blog_posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = $this->blogPostRepository->find($id);
        $tags = $this->blogTagRepository->all();
        return view('blog_posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();
        $this->blogPostRepository->update($validated, $id);
        return redirect()->route('blog_posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->blogPostRepository->delete($id);
        return redirect()->route('blog_posts.index');
    }
}
