<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NepaliPost;
use App\Models\EnglishPost;

class OtherPosts extends Component
{
    public $postTitle;
    public $posts = [];
    public $images = [];
    public function render()
    {
        return view('livewire.other-posts');
    }
  
    public function mount($post){
        $this->postTitle = $post;
        $this->postReturn();
    }
    public function postReturn(){
        $nepaliPost = NepaliPost::where('title', $this->postTitle)->first();
        $englishPost = EnglishPost::where('title', $this->postTitle)->first();
        if($englishPost){
            $selectedPost = EnglishPost::where('id','!=',$englishPost->id)
                                  ->take(8)
                                  ->get();
        }elseif($nepaliPost){
            $selectedPost = NepaliPost::where('id','!=',$nepaliPost->id)
                                ->take(8)
                                ->get();
        }
        $this->posts = $selectedPost;
    }
}
