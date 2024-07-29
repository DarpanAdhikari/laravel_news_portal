<?php

namespace App\Livewire;

use App\Models\abuse;
use App\Models\AbuseReport;
use App\Models\Comment;
use Livewire\Component;
use App\Models\NepaliPost;
use App\Models\EnglishPost;
use App\Models\Like;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CommentsLivewire extends Component
{
    public $comment, $author, $likes, $liked;
    public $postTitle;
    public $comments = [];
    public $replies = [];
    public $currentPage = 1;
    public $totalComments;
    public $lastPage;
    public $onlyPage;

    public function render()
    {
        return view('livewire.comments-livewire');
    }
    public function mount($post)
    {
        $this->postTitle = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $commentsPerPage = 5; // Assuming comments per page
        $offset = ($this->currentPage - 1) * $commentsPerPage;
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();

        if ($nepaliPost) {
            $this->comments = Comment::where('np_post_id', $nepaliPost->id)
                ->withCount('likes')
                ->with(['replies' => function ($query) {
                    $query->withCount('likes'); // Eager load likes count for replies
                }])
                ->skip($offset)
                ->take($commentsPerPage)
                ->get();
            $this->author = User::find($nepaliPost->author);
            $this->totalComments = Comment::where('np_post_id', $nepaliPost->id)->count();
            $this->likes = Like::where('np_post_id', $nepaliPost->id)->count();
        } elseif ($englishPost) {
            $this->comments = Comment::where('en_post_id', $englishPost->id)
                ->withCount('likes')
                ->with(['replies' => function ($query) {
                    $query->withCount('likes'); // Eager load likes count for replies
                }])
                ->skip($offset)
                ->take($commentsPerPage)
                ->get();
            $this->author = User::find($englishPost->author);
            $this->totalComments = Comment::where('en_post_id', $englishPost->id)->count();
            $this->likes = Like::where('en_post_id', $englishPost->id)->count();
        } else {
            $this->comments = collect();
        }

        $this->lastPage = $this->totalComments <= ($commentsPerPage * $this->currentPage);
        $this->onlyPage = $this->totalComments > $commentsPerPage;
    }

    public function initializeReplies($comments)
    {
        return $comments->pluck('id')->mapWithKeys(function ($id) {
            return [$id => ['reply' => '', 'reply_no' => $id, 'likes_count' => $this->calculateLikesCount($id)]];
        })->toArray();
    }

    private function calculateLikesCount($commentId)
    {
        $comment = Comment::firstWhere('id', $commentId);
        if ($comment) {
            $likesCount = $comment->likes_count;
            foreach ($comment->replies as $reply) {
                $likesCount += $reply->likes_count;
            }
            return $likesCount;
        }
        return 0;
    }


    public function loadMore()
    {
        if ($this->lastPage) {
            return;
        }
        $this->currentPage++;
        $this->loadComments();
    }

    public function loadPrevious()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadComments();
        }
    }

    // create comment
    public function submitComment()
    {
        $this->validate([
            'comment' => 'required|string',
        ]);
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();
        if ($nepaliPost) {
            Comment::create([
                'u_id' => Auth::user()->id,
                'np_post_id' => $nepaliPost->id,
                'body' => $this->comment,
            ]);
            $this->comment = '';
        } elseif ($englishPost) {
            Comment::create([
                'u_id' => Auth::user()->id,
                'en_post_id' => $englishPost->id,
                'body' => $this->comment,
            ]);
            $this->comment = '';
        }
        $this->mount($this->postTitle);
    }
    // create reply
    public function submitReply($commentId)
    {
        $this->validate([
            "replies.{$commentId}.reply_no" => [
                'required',
                'integer',
                Rule::exists('comments', 'id')->where(function ($query) use ($commentId) {
                    return $query->where('id', $commentId);
                }),
            ],
            "replies.{$commentId}.reply" => 'required|string',
        ]);
        Comment::create([
            'u_id' => Auth::user()->id,
            'body' => $this->replies[$commentId]['reply'],
            'parent_id' => $this->replies[$commentId]['reply_no'],
        ]);
        $this->mount($this->postTitle);
        $this->replies[$commentId]['reply'] = '';
    }
    // delete comments or reply
    public function delete($commentId)
    {
        if ($this->checkCommentor($commentId)) {
            $comment = Comment::find($commentId);
            $comment->delete();
            $this->mount($this->postTitle);
        }
    }
    private function checkCommentor($id)
    {
        $comment = Comment::find($id);
        return Auth::user()->id == $comment->u_id;
    }

    public function like($liked)
    {
        if (!$this->checkCommentor($liked)) {
            $comment = Comment::find($liked);
            $user = auth()->id();
            if ($comment) {
                $liked = Like::where('u_id', $user)
                    ->where('comment_id', $liked)
                    ->first();
                if (!$liked) {
                    Like::create([
                        'u_id' => $user,
                        'comment_id' => $comment->id,
                    ]);
                } else {
                    $liked->delete();
                }
                $this->mount($this->postTitle);
            }
        }
    }

    public function isLiked($commentId)
    {
        if (Auth::check()) {
            $userLikes = Auth::user()->likes->pluck('comment_id')->toArray();
            return in_array($commentId, $userLikes);
        }
        return false;
    }

    // like on post
    public function likePost()
    {
        if (!Auth::check()) {
            return;
        }
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();
        $user = Auth::user()->id;
        if ($nepaliPost) {
            $liked = Like::where('u_id', $user)
                ->where('np_post_id', $nepaliPost->id)
                ->first();
            if (!$liked) {
                Like::create([
                    'u_id' => $user,
                    'np_post_id' => $nepaliPost->id,
                ]);
            } else {
                $liked->delete();
            }
        } elseif ($englishPost) {
            $liked = Like::where('u_id', $user)
                ->where('en_post_id', $englishPost->id)
                ->first();
            if (!$liked) {
                Like::create([
                    'u_id' => $user,
                    'en_post_id' => $englishPost->id,
                ]);
            } else {
                $liked->delete();
            }
        }
        $this->mount($this->postTitle);
    }
    public function isPostLiked()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();
            $englishPost = EnglishPost::where('title', $this->postTitle)->first();
            if ($nepaliPost) {
                $nepaliPostLikes = $user->likes->pluck('np_post_id')->toArray();
                return in_array($nepaliPost->id, $nepaliPostLikes);
            } elseif ($englishPost) {
                $englishPostLikes = $user->likes->pluck('en_post_id')->toArray();
                return in_array($englishPost->id, $englishPostLikes);
            } else {
                return false;
            }
        }
        return false;
    }

    // abuse complaints
    public function abuse($id)
    {
        if (auth()->check()) {
            $comment = Comment::withCount('abuse')->find($id);
            $reported = AbuseReport::where('u_id', auth()->id())
                ->where('comment_id', $id)
                ->exists();

            if ($comment && $comment->abuse_count == 5 && !$reported) {
                $comment->delete();
            } elseif (!$reported && $comment->abuse_count < 5) {
                AbuseReport::create([
                    'u_id' => auth()->id(),
                    'comment_id' => $id,
                ]);
            }
        }
        $this->mount($this->postTitle);
    }
}
