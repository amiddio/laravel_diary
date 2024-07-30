<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use App\Repositories\LikeDislikeRepository;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * @param BlogRepository $blogRepository
     * @param CommentRepository $commentRepository
     * @param LikeDislikeRepository $likeDislikeRepository
     */
    public function __construct(
        protected BlogRepository $blogRepository,
        protected CommentRepository $commentRepository,
        protected LikeDislikeRepository $likeDislikeRepository
    ) {}

    /**
     * @param string|null $tag_name
     * @return View
     */
    public function index(?string $tag_name = null): View
    {
        $posts = $this->blogRepository->list(tag_name: $tag_name);

//        $r = $posts[0]->comments()->count();
//        dump($r);

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

        $comments = $this->commentRepository->all(post_id: $post->id, commentable_type: 'blog_comment');
        $likeDislike = $this->likeDislikeRepository->getVotes(modelType: 'blog_likedislike', modelId: $post->id);

        return view('blog.detail', compact('post', 'comments', 'likeDislike'));
    }

}
