<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function HomeContent()
    {
        if (App::getLocale() == 'np') {
            $lang = 'NepaliPost';
        } else {
            $lang = 'EnglishPost';
        }

        $postModel = "App\\Models\\{$lang}";
        $headline = resolve($postModel)::posts()
            ->where('created_at', '>=', now()->subDay())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $headlineIds = $headline->pluck('id');
        $buletine = resolve($postModel)::posts()
            ->where('created_at', '>=', now()->subDay())
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $headlineIds)
            ->take(6)
            ->get();

        $ignoreIds = $headlineIds->merge($buletine->pluck('id'));
        $firstCat = resolve($postModel)::posts()
            ->where('category', 1)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(15)
            ->get();
        // dd(count($firstCat));

        $fifthCat = resolve($postModel)::posts()
            ->where('category', 5)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(4)
            ->get();

        $blog = $this->categoriesTranslate('blog');
        $blogs = resolve($postModel)::posts()
            ->where('sub_category', $blog)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(3)
            ->get();

        $nation = $this->categoriesTranslate('national');
        $national = resolve($postModel)::posts()
            ->where('sub_category', $nation)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(13)
            ->get();

        $trendings = $this->TrendingPosts($postModel);

        $tech = $this->categoriesTranslate('com-tech');
        $technology = resolve($postModel)::posts()
            ->where('sub_category', $tech)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(5)
            ->get();

        $mostCommented = resolve($postModel)::posts()
            ->withCount('comments')
            ->orderByDesc('comments_count')
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->having('comments_count', '>', 0)
            ->take(5)
            ->get();

        $interview = $this->categoriesTranslate('interview');
        $interviews = resolve($postModel)::posts()
            ->where('sub_category', $interview)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(5)
            ->get();

        $exist = $headlineIds->merge($ignoreIds->pluck('id'));
        $rememberPost = resolve($postModel)::posts()
            ->where('sub_category', $interview)
            ->withCount('views')
            ->orderByDesc('views_count')
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $interviews->pluck('id'))
            ->whereNotIn('id', $exist)
            ->take(7)
            ->get();

        $secondCat = resolve($postModel)::posts()
            ->where('category', 2)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(12)
            ->get();

        $fourthCat = resolve($postModel)::posts()
            ->where('category', 4)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(9)
            ->get();

        $thirdCat = resolve($postModel)::posts()
            ->where('category', 3)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(8)
            ->get();

        $sixthCat = resolve($postModel)::posts()
            ->where('category', 6)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(6)
            ->get();

        $suggestions = resolve($postModel)::posts()
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->whereNotIn('id', $rememberPost->pluck('id'))
            ->whereNotIn('id', $headline->pluck('id'))
            ->whereNotIn('id', $buletine->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $international = $this->footerNavTranslate([0, 4]);
        $internation = resolve($postModel)::posts()
            ->where('sub_category', $international)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(9)
            ->get();

        $Literature = $this->footerNavTranslate([0, 2]);
        $Literatures = resolve($postModel)::posts()
            ->where('sub_category', $Literature)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(5)
            ->get();

        $worldContent = $this->categoriesTranslate('intr-wrld');
        $worldsContent = resolve($postModel)::posts()
            ->where('sub_category', $worldContent)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(8)
            ->get();

        $travel = $this->categoriesTranslate('travels');
        $travels = resolve($postModel)::posts()
            ->where('sub_category', $travel)
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', $ignoreIds)
            ->take(8)
            ->get();
        return view('pages.welcome',['headline' => $headline, 'buletine' => $buletine, 'firstCat' => $firstCat, 'fifthCat' => $fifthCat, 'blogs' => $blogs, 'national' => $national, 'trending' => $trendings, 'technologies' => $technology, 'mostCommented' => $mostCommented, 'interviews' => $interviews, 'remem' => $rememberPost, 'secondCat' => $secondCat, 'fourthCat' => $fourthCat, 'thirdCat' => $thirdCat, 'sixthCat' => $sixthCat, 'suggestions' => $suggestions, 'international' => $internation, 'literature' => $Literatures, 'worldsContent' => $worldsContent, 'travels'=>$travels]);
    }

    //getting trending post
    protected function TrendingPosts($postModel)
    {
        $posts = resolve($postModel)::posts()
            ->withCount('likes', 'comments', 'views')
            ->get();

        $posts = $posts->map(function ($post) {
            $weights = [
                'likes' => 1.2,
                'comments' => 1,
                'views' => 0.4,
            ];
            $score = $weights['likes'] * $post->likes_count
                + $weights['comments'] * $post->comments_count
                + $weights['views'] * $post->views_count;
            $post->trending_score = $score;
            return $post;
        });
        $sortedPosts = $posts->sortByDesc('trending_score')->take(10);

        return $sortedPosts;
    }

    // translate and get data
    private function categoriesTranslate($searchTerm)
    {
        if (App::getLocale() == 'np') {
            $npJsonContent = File::get(base_path("lang/np.json"));
            $data = json_decode($npJsonContent, true);
        } else {
            $enJsonContent = File::get(base_path("lang/en.json"));
            $data = json_decode($enJsonContent, true);
        }

        if (array_key_exists($searchTerm, $data['categories'])) {
            $categoryValue = $data['categories'][$searchTerm];
            return $categoryValue;
        }
    }

    private function footerNavTranslate($searchPosition)
    {
        if (App::getLocale() == 'np') {
            $npJsonContent = File::get(base_path("lang/np.json"));
            $data = json_decode($npJsonContent, true);
        } else {
            $enJsonContent = File::get(base_path("lang/en.json"));
            $data = json_decode($enJsonContent, true);
        }
        $searchValue = '';
        foreach ($data['footerNav'] as $key => $subArray) {
            if ($key !== 'name') {
                if ($key == $searchPosition[0] && isset($subArray[$searchPosition[1]])) {
                    $searchValue = $subArray[$searchPosition[1]];
                    break;
                }
            }
        }
        if (!empty($searchValue)) {
            return $searchValue;
        }
    }
}
