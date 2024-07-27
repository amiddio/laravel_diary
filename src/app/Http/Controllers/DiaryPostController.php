<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryPostRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\DiaryPostRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class DiaryPostController extends Controller
{

    /**
     * @param DiaryPostRepository $diaryPostRepository
     */
    public function __construct(
        protected DiaryPostRepository $diaryPostRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = $this->diaryPostRepository->all();

        return view('diary_posts.index', compact('posts'));
    }

    /**
     * @param string $slug
     * @return View
     */
    public function filtered(string $slug): View
    {
        $posts = $this->diaryPostRepository->all(slug: $slug);

        return view('diary_posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('diary_posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiaryPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $result = $this->diaryPostRepository->create(data: $validated);
        if ($result) {
            self::setAlert(status: 'success', message: __('Post created successfully!'));
        }

        return redirect()->route('diary_posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = $this->diaryPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('view', $post);

        return view('diary_posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = $this->diaryPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('view', $post);

        return view('diary_posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiaryPostRequest $request, string $id): RedirectResponse
    {
        $post = $this->diaryPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('update', $post);

        $validated = $request->validated();
        $post = $this->diaryPostRepository->update($post, $validated);
        if ($post->wasChanged()) {
            self::setAlert(status: 'success', message: __('Post edited successfully!'));
        }

        return redirect()->route('diary_posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = $this->diaryPostRepository->find($id);
        if (!$post) {
            abort(404);
        }

        Gate::authorize('delete', $post);

        if ($this->diaryPostRepository->delete($post)) {
            self::setAlert(status: 'success', message: __('Post was deleted!'));
        }

        return redirect()->route('diary_posts.index');
    }
}
