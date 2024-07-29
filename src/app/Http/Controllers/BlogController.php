<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        protected BlogRepository $blogRepository
    ) {}

    /**
     * @param string|null $tag_name
     * @return View
     */
    public function index(?string $tag_name = null): View
    {
        $posts = $this->blogRepository->list(tag_name: $tag_name);

        return view('blog.index', compact('posts'));
    }

    /**
     * @param string $user_id
     * @param string $slug
     * @return View
     */
    public function show(string $user_id, string $slug): View
    {
        $post = $this->blogRepository->detail(user_id: $user_id, slug: $slug);
        if (!$post) {
            abort(404);
        }

        return view('blog.detail', compact('post'));
    }

}
