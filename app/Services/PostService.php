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
use App\Repository\SexualContextRepository;
use App\Repository\SexualContextRepositoryEloquent;
use Auth;
use App\Traits\SummernoteTrait;
use App\Traits\FireBaseTrait;
use Illuminate\Session\Store as Session;

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
    /** @var SexualContextRepositoryEloquent */
    protected $sexualContextRepository;

    public function __construct()
    {
        $this->postRepository          = app(PostRepository::class);
        $this->postTagRepository       = app(PostTagRepository::class);
        $this->session                 = app(Session::class);
        $this->commentRepository       = app(CommentRepository::class);
        $this->postVoteRepository      = app(PostVoteRepository::class);
        $this->followRepository        = app(FollowRepository::class);
        $this->sexualContextRepository = app(SexualContextRepository::class);
    }

    public function create($input)
    {
        $input['user_id'] = Auth::id();
        $input['status']  = config('constant.post.status.pending');
        if (array_key_exists('files', $input)) {
            $input['content'] = $this->convertImg($input['content']);
        }
        list($status, $message) = $this->checkingSexualContent($input);
        if ($status) {
            $post = $this->postRepository->create($input);
            $this->pushNotificationForFollower($post['data']);
            return [$status, $message];
        } else {
            return [$status, $message];
        }
    }

    private function checkingSexualContent($input)
    {
        $title        = $input['title'];
        $tags         = $input['tags'];
        $content      = $input['content'];
        $banned_words = $this->sexualContextRepository->getBannedWords();
        foreach ($banned_words as $word) {
            if (strpos($tags, $word->context) || strpos($content, $word->context) || strpos($title, $word->context)) {
                return [false, 'Title, Content or Tags must not have banned word: ' . $word->context];
            }
        }

        return [true, 'Content is valid'];
    }

    private function pushNotificationForFollower($post)
    {
        $user      = Auth::user();
        $followers = $user->followings;
        foreach ($followers as $follower) {
            $data = [
                'action'     => 'create_post_follows',
                'content'    => $user->name . ' have posted a new article',
                'created_at' => microtime(true) * 1000,
                'is_read'    => false,
                'user_id'    => (string)$follower->user_id,
                'href'       => 'post/' . $post->id,
                'title'      => $post->title,
            ];
            $this->addData('notifications', $data);
        }
    }

    public function listByUser()
    {
        $userId = Auth::id();
        return $this->postRepository->findByFields('user_id', $userId);
    }

    public function find($id)
    {
        $post = $this->postRepository->find($id);
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

    public function update($id, $input)
    {
        if (!is_null($input['files'])) {
            $input['content'] = $this->convertImg($input['content']);
        }
        list($status, $message) = $this->checkingSexualContent($input);
        if ($status) {
            $this->postRepository->update($id, $input);
            $tags = $this->postRepository->generateTagFromString($input);
            $this->postTagRepository->deleteTags($tags, $id);
            $this->postTagRepository->updateMany(['post_id' => $id], $tags);
            return [$status, $message];
        } else {
            return [$status, $message];
        }
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
        $viewed = $this->session->get('viewed_post', []);
        return in_array($post->id, $viewed);
    }

    public function comment($postId, $input)
    {
        $userId           = Auth::id();
        $input['user_id'] = $userId;
        $input['post_id'] = $postId;
        $comment          = $this->commentRepository->create($input);
        $comment->user;

        return $comment;
    }

    public function vote($postId)
    {
        $userId = Auth::id();
        return $this->postVoteRepository->votePost($postId, $userId);
    }

    public function findWithTrashed($id)
    {
        $post = $this->postRepository->findWithTrashed($id);
        list($tags, $comments, $followed) = $this->getPostInfo($post);

        return [$post, $tags, $comments, $followed];
    }

    public function uploadBannedWords($file)
    {
        $data        = [];
        $this->changeFileDelimiter($file);
        $file_handle = fopen($file, "r");
        while (!feof($file_handle)) {
            $row = fgetcsv($file_handle, '1000', ';');
            if ($row) {
                $data[]['context'] = $row[0];
            }
        }
        foreach ($data as $param) {
            $this->sexualContextRepository->createBannedWords($param);
        }

        return [true, 'Upload complete'];
    }

    private function changeFileDelimiter($file)
    {
        $delimiters = array('|', ',', '^', "\t");
        $delimiter = ';';
        $str = file_get_contents($file);
        $str = str_replace($delimiters, $delimiter, $str);
        file_put_contents($file, $str);
    }
}
