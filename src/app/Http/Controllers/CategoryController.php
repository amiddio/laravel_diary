<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->categoryRepository->create(data: $validated);

        $this->setAlert(status: 'success', message: __('Category created successfully!'));

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = $this->categoryRepository->find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();
        $was_changed = $this->categoryRepository->update($validated, $id);

        if ($was_changed) {
            $this->setAlert(status: 'success', message: __('Category edited successfully!'));
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->categoryRepository->delete($id);

        $this->setAlert(status: 'success', message: __('Category was deleted!'));

        return redirect()->route('categories.index');
    }

}
