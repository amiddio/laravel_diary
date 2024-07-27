<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogTagRequest;
use App\Repositories\BlogTagRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

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

        $result = $this->blogTagRepository->create(data: $validated);
        if ($result) {
            self::setAlert(status: 'success', message: __('Tag created successfully!'));
        }

        return redirect()->route('blog_tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $tag = $this->blogTagRepository->find($id);
        if (!$tag) {
            abort(404);
        }

        Gate::authorize('view', $tag);

        return view('blog_tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogTagRequest $request, string $id): RedirectResponse
    {
        $tag = $this->blogTagRepository->find($id);
        if (!$tag) {
            abort(404);
        }

        Gate::authorize('update', $tag);

        $validated = $request->validated();

        $tag = $this->blogTagRepository->update(instance: $tag, data: $validated);
        if ($tag->wasChanged()) {
            self::setAlert(status: 'success', message: __('Tag edited successfully!'));
        }

        return redirect()->route('blog_tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $tag = $this->blogTagRepository->find($id);
        if (!$tag) {
            abort(404);
        }

        Gate::authorize('delete', $tag);

        if ($this->blogTagRepository->delete($tag)) {
            self::setAlert(status: 'success', message: __('Tag was deleted!'));
        }

        return redirect()->route('blog_tags.index');
    }
}
