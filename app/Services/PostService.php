<?php

namespace App\Services;

use App\Entities\Post;
use App\Repository\CommentRepositoryEloquent;
use App\Repository\FollowRepositoryEloquent;
use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Repository\PostTagRepositoryEloquent;
use App\Repository\PostVoteRepository;
use App\Repository\PostTagRepository;
use App\Repository\CommentRepository;
use App\Repository\FollowRepository;
use App\Repository\PostVoteRepositoryEloquent;
use Illuminate\Support\Facades\Auth;
use App\Traits\SummernoteTrait;
use App\Traits\FireBaseTrait;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Facades\Cache;

class PostService
{
    use SummernoteTrait;
    use FirebaseTrait;

    /** @var PostRepositoryEloquent */
    protected $postRepository;
    /** @var PostTagRepositoryEloquent */
    protected $postTagRepository;
    /** @var CommentRepositoryEloquent */
    protected $commentRepository;
    /** @var PostVoteRepositoryEloquent */
    protected $postVoteRepository;
    protected $session;
    /** @var FollowRepositoryEloquent */
    protected $followRepository;

    public function __construct()
    {
        $this->postRepository     = app(PostRepository::class);
        $this->postTagRepository  = app(PostTagRepository::class);
        $this->session            = app(Session::class);
        $this->commentRepository  = app(CommentRepository::class);
        $this->postVoteRepository = app(PostVoteRepository::class);
        $this->followRepository   = app(FollowRepository::class);
    }

    public function create($input)
    {
        $input['user_id'] = Auth::id();
        $input['status']  = config('constant.post.status.pending');
        $input['slug']    = str_slug($input['title']);
        if (array_key_exists('files', $input)) {
            $input['content'] = $this->convertImg($input['content']);
        }
        $this->postRepository->create($input);
        return [true, 'Create post success'];
    }

    public function listByUser()
    {
        $userId = Auth::id();
        return $this->postRepository->findByFields('user_id', $userId);
    }

    public function find($slug)
    {
        $post = $this->postRepository->findWhereGetFirst(['slug' => $slug]);
        list($tags, $comments, $followed) = $this->getPostInfo($post);
        return [$post, $tags, $comments, $followed];
    }

    private function getPostInfo($post)
    {
        $tags     = implode(',', $post->tags->pluck('name')->toArray());
        $comments = $post->comments;
        $author   = $post->user_id;
        $followed = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            if ($this->followRepository->findWhereGetFirst(['follower_id' => $author, 'user_id' => $userId])) {
                $followed = 1;
            }
        }
        return [$tags, $comments, $followed];
    }

    public function findBySlug($slug)
    {
        $post = $this->postRepository->findWhereGetFirst(['slug' => $slug]);
        list($tags, $comments, $followed) = $this->getPostInfo($post);
        return [$post, $tags, $comments, $followed];
    }

    /**
     * @param $slug
     * @param $input
     * @return array
     * @throws \Exception
     */
    public function update($slug, $input)
    {
        $input['slug'] = str_slug($input['title']);
        $post          = $this->postRepository->findWhereGetFirst(['slug' => $slug]);
        $id            = $post->id;

        if (!is_null($input['files'])) {
            $input['content'] = $this->convertImg($input['content']);
        }
        $this->postRepository->update($id, $input);
        $tags = $this->postRepository->generateTagFromString($input);
        $this->postTagRepository->deleteTags($tags, $id);

        $this->postTagRepository->updateMany(['post_id' => $id], $tags);

        return [true, 'Update is success'];
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function countView($post)
    {
        if (!$this->checkViewed($post)) {
            $this->session->push('viewed_post', $post->id);
            $post->view += 1;
            $post->save();
            return true;
        }
        return false;
    }

    /**
     * @param Post $post
     * @return bool
     */
    private function checkViewed($post)
    {
        $viewed = $this->session->get('viewed_post') ?? [];
        return in_array($post->id, $viewed);
    }

    public function comment($slug, $input)
    {
        $userId           = Auth::id();
        $input['user_id'] = $userId;
        $post             = $this->postRepository->findWhereGetFirst(['slug' => $slug]);
        $postId           = $post->id;

        $input['post_id'] = $postId;
        $comment          = $this->commentRepository->create($input);
        $comment->user;

        return $comment;
    }

    public function vote($slug)
    {
        $userId = Auth::id();
        $post   = $this->postRepository->findWhereGetFirst(['slug' => $slug]);
        $postId = $post->id;
        return $this->postVoteRepository->votePost($postId, $userId);
    }

    /**
     * @param $slug
     * @return array
     */
    public function findWithTrashed($slug)
    {
        $post = $this->postRepository->findWithTrashed($slug);
        list($tags, $comments, $followed) = $this->getPostInfo($post);

        return [$post, $tags, $comments, $followed];
    }

    /**
     * @param $slug
     * @return array
     * @throws \Google\Cloud\Core\Exception\GoogleException
     */
    public function publish($slug)
    {
        list($status, $message, $post) = $this->postRepository->publish($slug);
        if ($status) {
            $this->pushNotificationForFollower($post);
        }
        return [$status, $message];
    }

    /**
     * @param $post
     * @throws \Google\Cloud\Core\Exception\GoogleException
     */
    private function pushNotificationForFollower($post)
    {
        $user      = $post->user;
        $followers = $user->followings;
        foreach ($followers as $follower) {
            $data = [
                'action'     => 'create_post_follows',
                'content'    => $user->name . ' have posted a new article',
                'created_at' => microtime(true) * 1000,
                'is_read'    => false,
                'user_id'    => (string)$follower->user_id,
                'href'       => 'post/' . $post->slug,
                'title'      => $post->title,
            ];
            $this->addData('notifications', $data);
        }
    }

    public function browsePosts($params)
    {
        $posts = $this->postRepository->getPosts($params);
        try {
            $html = view('Post.Index.body', compact('posts'))->render();
            return [true, 200, 'Retrieve post success', $html];
        } catch (\Throwable $e) {
            return [false, 404, $e->getMessage(), null];
        }
    }
}
