<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Cabinet\CategoryRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->all();

        return view('cabinet.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cabinet.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $result = $this->categoryRepository->create(data: $validated);
        if ($result) {
            self::setAlert(status: 'success', message: __('Category created successfully!'));
        }

        return redirect()->route('cabinet.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            abort(404);
        }

        Gate::authorize('view', $category);

        return view('cabinet.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            abort(404);
        }

        Gate::authorize('update', $category);

        $validated = $request->validated();
        $category = $this->categoryRepository->update($category, $validated);
        if ($category->wasChanged()) {
            self::setAlert(status: 'success', message: __('Category edited successfully!'));
        }

        return redirect()->route('cabinet.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            abort(404);
        }

        Gate::authorize('delete', $category);

        if ($this->categoryRepository->delete($category)) {
            self::setAlert(status: 'success', message: __('Category was deleted!'));
        }

        return redirect()->route('cabinet.categories.index');
    }

}
