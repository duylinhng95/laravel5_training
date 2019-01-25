<?php

namespace App\Services;

use App\Repository\PostRepository;
use App\Repository\PostVoteRepository;
use App\Repository\PostTagRepository;
use App\Repository\CommentRepository;
use App\Repository\FollowRepository;
use Auth;
use App\Traits\SummernoteTrait;
use Illuminate\Session\Store as Session;

class PostService
{
    use SummernoteTrait;

    protected $postRepository;
    protected $postTagRepository;
    protected $commentRepository;
    protected $postVoteRepository;
    protected $session;
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
        $input['user_id'] = Auth::user()->id;
        if (array_key_exists('files', $input)) {
            $input['content'] = $this->convertImg($input['content']);
        }
        return $this->postRepository->create($input);
    }

    public function listByUser()
    {
        $userId = Auth::user()->id;
        return $this->postRepository->findByFields('user_id', $userId);
    }

    public function find($id)
    {
        $post     = $this->postRepository->find($id);
        list($tags, $comments, $followed) = $this->getPostInfo($post);
        return [$post, $tags, $comments, $followed];
    }

    public function update($id, $input)
    {
        if (!is_null($input['files'])) {
            $input['content'] = $this->convertImg($input['content']);
        }
        $this->postRepository->update($id, $input);
        $tags = $this->postRepository->generateTagFromString($input);
        $this->postTagRepository->deleteTags($tags, $id);
        $this->postTagRepository->updateMany(['post_id' => $id], $tags);
        return ['code' => 202, 'message' => "Update Post Success"];
    }

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

    private function checkViewed($post)
    {
        $viewed = $this->session->get('viewed_post', []);
        return in_array($post->id, $viewed);
    }

    public function comment($postId, $input)
    {
        $userId           = Auth::user()->id;
        $input['user_id'] = $userId;
        $input['post_id'] = $postId;
        $comment          = $this->commentRepository->create($input);
        $comment->user;

        return $comment;
    }

    public function vote($postId)
    {
        $userId = Auth::user()->id;
        return $this->postVoteRepository->votePost($postId, $userId);
    }


    public function findWithTrashed($id)
    {
        $post   = $this->postRepository->findWithTrashed($id);
        list($tags, $comments, $followed) = $this->getPostInfo($post);

        return [$post, $tags, $comments, $followed];
    }

    private function getPostInfo($post)
    {
        $tags     = implode(',', $post->tags->pluck('name')->toArray());
        $comments = $post->comments;
        $followed = 0;
        $user     = Auth::user();
        $author   = $post->user_id;
        if ($this->followRepository->findWhereGetFirst(['follower_id' => $author, 'user_id' => $user->id])) {
            $followed = 1;
        }

        return [$tags, $comments, $followed];
    }
}
