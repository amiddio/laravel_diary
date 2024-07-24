<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogTagRequest;
use App\Repositories\BlogTagRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BlogTagController extends Controller
{

    /**
     * @param BlogTagRepository $blogTagRepository
     */
    public function __construct(
        protected BlogTagRepository $blogTagRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tags = $this->blogTagRepository->all();
        return view('blog_tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('blog_tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogTagRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->blogTagRepository->create(data: $validated);
        return redirect()->route('blog_tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $tag = $this->blogTagRepository->find($id);
        return view('blog_tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogTagRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();
        $this->blogTagRepository->update(data: $validated, id: $id);
        return redirect()->route('blog_tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->blogTagRepository->delete($id);
        return redirect()->route('blog_tags.index');
    }
}
