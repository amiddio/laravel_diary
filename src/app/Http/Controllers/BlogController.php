<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * @param BlogRepository $blogRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(
        protected BlogRepository $blogRepository,
        protected CommentRepository $commentRepository
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

        $comments = $this->commentRepository->all(post_id: $post->id);

        return view('blog.detail', compact('post', 'comments'));
    }

}
