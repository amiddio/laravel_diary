<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{

    /**
     * @param CommentRepository $commentRepository
     */
    public function __construct(
        protected CommentRepository $commentRepository
    ) {}

    /**
     * @param CommentStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CommentStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $result = $this->commentRepository->create(data: $validated);
        if ($result) {
            self::setAlert(status: 'success', message: __('Comment added successfully!'));
        }

        return redirect()->back();
    }

}
