<?php

namespace App\Http\Controllers;

use App\Exceptions\LikeDislikeException;
use App\Http\Requests\LikeDislikeBlogRequest;
use App\Models\BlogPost;
use App\Models\LikeDislike;
use App\Repositories\LikeDislikeRepository;
use Illuminate\Http\RedirectResponse;

class LikeDislikeController extends Controller
{

    /**
     * @param LikeDislikeRepository $likeDislikeRepository
     */
    public function __construct(
        protected LikeDislikeRepository $likeDislikeRepository
    ) {}

    /**
     * @param LikeDislikeBlogRequest $request
     * @return RedirectResponse
     */
    public function __invoke(LikeDislikeBlogRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->likeDislikeRepository->update(data: $validated);
            self::setAlert(status: 'success', message: __('Vote added successfully!'));
        } catch (LikeDislikeException $exception) {
            self::setAlert(status: 'danger', message: $exception->getMessage());
        }

        return redirect()->back();
    }
}
