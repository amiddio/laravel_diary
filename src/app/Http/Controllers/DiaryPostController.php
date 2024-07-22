<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryPostRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\DiaryPostRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        $this->diaryPostRepository->create(data: $validated);
        return redirect()->route('diary_posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = $this->diaryPostRepository->find($id);
        return view('diary_posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = $this->diaryPostRepository->find($id);
        return view('diary_posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiaryPostRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();
        $this->diaryPostRepository->update($validated, $id);
        return redirect()->route('diary_posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->diaryPostRepository->delete($id);
        return redirect()->route('diary_posts.index');
    }
}
