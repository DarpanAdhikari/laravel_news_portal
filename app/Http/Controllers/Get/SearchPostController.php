<?php

namespace App\Http\Controllers\Get;

use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Views;

class SearchPostController extends Controller
{
    public function SearchPost(Request $request, $searchValue)
    {
        $symbolsToReplace = ['/', '?', '=', '&', '+', '-', '_', '.', ',', ':', ';', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')'];
        $searchTerm = explode(' ', str_replace($symbolsToReplace, ' ', $searchValue));
        $searchTerm = array_filter($searchTerm, function ($word) {
            return strlen($word) > 3;
        });
        $englishPost = EnglishPost::where('status', '1')
            ->Where('slug', $searchValue)
            ->orWhere('title', $searchValue)
            ->first();
        $nepaliPost = NepaliPost::where('status', '1')
            ->Where('slug', $searchValue)
            ->orWhere('title', $searchValue)
            ->first();

        if ($nepaliPost || $englishPost) {
            if ($nepaliPost) {
                $enPost = EnglishPost::where('np_post_id', $nepaliPost->id)->posts()->first();
                $post = (App::getLocale() == 'np') ? $nepaliPost : ($enPost ? $enPost : $nepaliPost);
                // views count
                $this->viewsCount($post);

                return ['post' => $post];
            } elseif ($englishPost) {
                $npPost = NepaliPost::where('en_post_id', $englishPost->id)->posts()->first();
                $post = (App::getLocale() == 'en') ? $englishPost : ($npPost ? $npPost : $englishPost);
                // views count
                $this->viewsCount($post);
                return ['post' => $post];
            } else {
                return null;
            }
        } else {
            $postMatches = [];
            foreach ($searchTerm as $word) {
                $matchedPosts = EnglishPost::where('title', 'like', '%' . $word . '%')
                    ->orWhere('keywords', 'like', '%' . $word . '%')
                    ->orWhere('meta_description', 'like', '%' . $word . '%')
                    ->orWhere('content', 'like', '%' . $word . '%')
                    ->pluck('id')
                    ->toArray();
                foreach ($matchedPosts as $postId) {
                    if (!isset($postMatches[$postId])) {
                        $postMatches[$postId] = 0;
                    }
                    $postMatches[$postId]++;
                }
            }

            arsort($postMatches);
            $postId = key($postMatches);
            $englishPost = EnglishPost::where('id', $postId)
                ->posts()
                ->first();
            $npPost = null;
            if ($englishPost) {
                $npPost = NepaliPost::where('en_post_id', $englishPost->id)->first();
            }
            $getEnPost = (App::getLocale() == 'en') ? $englishPost : ($npPost ? $npPost : $englishPost);
            foreach ($searchTerm as $word) {
                $matchedPosts = NepaliPost::where('title', 'like', '%' . $word . '%')
                    ->orWhere('keywords', 'like', '%' . $word . '%')
                    ->orWhere('meta_description', 'like', '%' . $word . '%')
                    ->orWhere('content', 'like', '%' . $word . '%')
                    ->pluck('id')
                    ->toArray();
                foreach ($matchedPosts as $postId) {
                    if (!isset($postMatches[$postId])) {
                        $postMatches[$postId] = 0;
                    }
                    $postMatches[$postId]++;
                }
            }

            arsort($postMatches);
            $postId = key($postMatches);
            $nepaliPost = NepaliPost::where('id', $postId)
                ->posts()
                ->first();
            $enPost = null;
            if ($nepaliPost) {
                $enPost = EnglishPost::where('np_post_id', $nepaliPost->id)->first();
            }
            $getNpPost = (App::getLocale() == 'np') ? $nepaliPost : ($enPost ? $enPost : $nepaliPost);

            $post =  $getEnPost ? $getEnPost : $getNpPost;
            // views count
            $this->viewsCount($post);
            if ($post) {
                return [
                    'post' => $post,
                ];
            } else {
                return null;
            }
        }
    }
    private function viewsCount($post)
    {
        $ipAddress = request()->ip();
        $user = null;
        if(auth()->check()){
            $user = auth()->id();
        }
        if ($post instanceof NepaliPost) {
            $table = 'np_post_id';
            $existingView = Views::where('ip_address', $ipAddress)
                                   ->Where('np_post_id', $post->id)
                                   ->first();
        } elseif ($post instanceof EnglishPost) {
            $table = 'en_post_id';
            $existingView = Views::where('ip_address', $ipAddress)
                                   ->Where('en_post_id', $post->id)
                                   ->first();
        } else {
           return null;
        }
        if(!$existingView){
            Views::create([
                'u_id'=>$user,
                $table => $post->id,
                'ip_address' => $ipAddress,
            ]);
        }
    }
}
