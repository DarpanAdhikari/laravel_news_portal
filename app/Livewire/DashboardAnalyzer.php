<?php

namespace App\Livewire;

use App\Models\EnglishPost;
use App\Models\NepaliPost;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Views;
use Livewire\Component;

class DashboardAnalyzer extends Component
{
    public $enPostCount = [];
    public $npPostCount = [];
    public $enCmtCount =[]; 
    public $enLikeCount =[];
    public $enViews = []; 
    public $npCmtCount =[]; 
    public $npLikeCount =[]; 
    public $npViews = [];
    public $totalVisit, $npDraft, $enDraft, $runningAds;
    public function render()
    {
        return view('livewire.dashboard-analyzer');
    }
    public function mount()
    {
        $this->topInfo();
        $this->pieChart();
        $this->barChart();
    }
    public function topInfo(){
        $this->enDraft = EnglishPost::where('status', 0)->count();
        $this->npDraft = NepaliPost::where('status', 0)->count();
        $this->totalVisit = Views::distinct('ip_address')->count('ip_address');
    }
    public function pieChart()
    {
        for ($i = 1; $i < 8; $i++) {
            $this->enPostCount[$i] = EnglishPost::where('category', $i)->where('status',1)->count();
            $this->npPostCount[$i] = NepaliPost::where('category', $i)->where('status',1)->count();
        }
    }
    public function barChart()
    {
        for ($i = 1; $i < 8; $i++) {
            $enPostsWithComments = EnglishPost::withCount('comments')
            ->where('category', $i)
            ->where('status', 1)
            ->orderByDesc('comments_count')
            ->orderBy('created_at', 'desc')
            ->get();
        $enPostsWithLikes = EnglishPost::withCount('likes')
            ->where('category', $i)
            ->where('status', 1)
            ->orderByDesc('likes_count')
            ->orderBy('created_at', 'desc')
            ->get();
            $npPostsWithViews = EnglishPost::withCount('views')
            ->where('category', $i)
            ->where('status', 1)
            ->orderByDesc('views_count')
            ->orderBy('created_at', 'desc')
            ->get();
          $this->enCmtCount[$i] = $enPostsWithComments->sum('comments_count');
          $this->enLikeCount[$i] = $enPostsWithLikes->sum('likes_count');
          $this->enViews[$i] = $npPostsWithViews->sum('views_count');
            
            $npPostsWithComments = NepaliPost::withCount('comments')
            ->where('category', $i)
            ->where('status', 1)
            ->orderByDesc('comments_count')
            ->orderBy('created_at', 'desc')
            ->get();
           $npPostsWithLikes = NepaliPost::withCount('likes')
            ->where('category', $i)
            ->where('status', 1)
            ->orderByDesc('likes_count')
            ->orderBy('created_at', 'desc')
            ->get();
            $enPostsWithViews = NepaliPost::withCount('views')
            ->where('category', $i)
            ->where('status', 1)
            ->orderByDesc('views_count')
            ->orderBy('created_at', 'desc')
            ->get();
            $this->npCmtCount[$i] = $npPostsWithComments->sum('comments_count');
            $this->npLikeCount[$i] = $npPostsWithLikes->sum('likes_count');
            $this->npViews[$i] = $enPostsWithViews->sum('views_count');   
        }
    }


}
