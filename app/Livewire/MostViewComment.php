<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\User;
use Livewire\Component;
use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Support\Collection;

class MostViewComment extends Component
{
    public $postTitle;
    public $suggestedPost = [];
    public $mostLikedPosts = [];
    public $mostCommentedPosts = [];
    
    public function mount($post)
    {
        $this->postTitle = $post;
        $this->suggestion();
        $this->MostLiked();
        $this->MostCommented();
    }
    public function suggestion()
    {
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();
        if ($englishPost) {
            $combinedArray = array_unique(array_merge(
                preg_split('/\s+/', $englishPost->keywords . ' ' . $englishPost->tags, -1, PREG_SPLIT_NO_EMPTY)
            ));
            $combinedArray = array_filter($combinedArray, function ($word) {
                return strlen($word) > 3;
            });
            $suggestedPosts = EnglishPost::selectRaw('*, (' . implode(' + ', array_fill(
                0,
                count($combinedArray),
                '(
                CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, "")))'
            )) . ') AS relevance_score', $combinedArray)
                ->where('id', '!=', $englishPost->id)
                ->posts()
                ->orderByDesc('relevance_score')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } elseif ($nepaliPost) {
            $combinedArray = array_unique(array_merge(
                preg_split('/\s+/', $nepaliPost->keywords . ' ' . $nepaliPost->tags, -1, PREG_SPLIT_NO_EMPTY)
            ));
            $combinedArray = array_filter($combinedArray, function ($word) {
                return strlen($word) > 3;
            });
            $suggestedPosts = NepaliPost::selectRaw('*, (' . implode(' + ', array_fill(
                0,
                count($combinedArray),
                '(
                CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, "")))'
            )) . ') AS relevance_score', $combinedArray)
                ->where('id', '!=', $nepaliPost->id)
                ->posts()
                ->orderByDesc('relevance_score')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } else {
            $suggestedPosts = collect();
        }
        $this->suggestedPost = $suggestedPosts;
    }

    public function MostLiked()
    {
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();

        if ($englishPost) {
            $mostLikedPosts = EnglishPost::withCount('likes')
                ->where('title', '!=', $this->postTitle)
                ->posts()
                ->orderByDesc('likes_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } elseif ($nepaliPost) {
            $mostLikedPosts = NepaliPost::withCount('likes')
                ->where('title', '!=', $this->postTitle)
                ->posts()
                ->orderByDesc('likes_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } else {
            if(session('locale') == 'np'){
                $mostLikedPosts = NepaliPost::withCount('likes')
                ->posts()
                ->orderByDesc('likes_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            }else{
                $mostLikedPosts = EnglishPost::withCount('likes')
                ->posts()
                ->orderByDesc('likes_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            }
        }
        $this->mostLikedPosts = $mostLikedPosts;
    }
    public function MostCommented()
    {
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();

        if ($englishPost) {
            $mostCommentedPosts = EnglishPost::withCount('comments')
                ->where('title', '!=', $this->postTitle)
                ->posts()
                ->orderByDesc('comments_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } elseif ($nepaliPost) {
            $mostCommentedPosts = NepaliPost::withCount('comments')
                ->where('title', '!=', $this->postTitle)
                ->posts()
                ->orderByDesc('comments_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } else {
            if(session('locale') == 'np'){
                $mostCommentedPosts = NepaliPost::withCount('comments')
                ->posts()
                ->orderByDesc('comments_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            }else{
                $mostCommentedPosts = EnglishPost::withCount('comments')
                ->posts()
                ->orderByDesc('comments_count')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            }
        }
        $this->mostCommentedPosts = $mostCommentedPosts;
    }
    public function render()
    {
        return view('livewire.most-view-comment');
    }
}
