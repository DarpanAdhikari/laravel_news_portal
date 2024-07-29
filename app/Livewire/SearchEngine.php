<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Support\Facades\App;

class SearchEngine extends Component
{
    public $search;
    public $postSearch = [];

    public function searchEngine($search)
    {
        if (empty(trim($search))) {
            $this->postSearch = null;
            return;
        }
        
        $symbolsToReplace = ['/','?', '=', '&', '+', '-', '_', '.', ',', ':', ';', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')'];
        $searchTerms = explode(' ', str_replace($symbolsToReplace, ' ', $search));
        $searchTerms = array_filter($searchTerms, function($term) {
            return trim($term) !== ''; 
        });
        $englishPosts = [];
        $nepaliPosts = [];
        
        if (App::getLocale() == 'np') {
            foreach ($searchTerms as $word) {
                $nepaliPosts[] = NepaliPost::selectRaw(
                    '*, 
                 (CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) AS content_relevance,
                 (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, ""))) AS keywords_relevance,
                 (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, ""))) AS tags_relevance,
                 ((CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) 
                     + (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, "")))
                     + (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, "")))) AS total_relevance',
                    [$word, $word, $word, $word, $word, $word]
                 )
                    ->posts()
                    ->orderByDesc('total_relevance')
                    ->orderBy('created_at', 'desc')
                    ->havingRaw('total_relevance > 0')
                    //->limit(6)
                    ->get();
            }
        
            $allNepaliPosts = collect($nepaliPosts)->flatten();
            if ($allNepaliPosts->isNotEmpty()) {
                $this->postSearch = $allNepaliPosts;
                return;
            }
            foreach ($searchTerms as $word) {
                $englishPosts[] = EnglishPost::selectRaw(
                    '*, 
                 (CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) AS content_relevance,
                 (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, ""))) AS keywords_relevance,
                 (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, ""))) AS tags_relevance,
                 ((CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) 
                     + (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, "")))
                     + (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, "")))) AS total_relevance',
                    [$word, $word, $word, $word, $word, $word]
                 )
                    ->posts()
                    ->orderByDesc('total_relevance')
                    ->orderBy('created_at', 'desc')
                    ->havingRaw('total_relevance > 0')
                    //->limit(6)
                    ->get();
            }
        
            $allEnglishPosts = collect($englishPosts)->flatten();
        
            // If search term found in English posts, check corresponding Nepali posts and return them
            if ($allEnglishPosts->isNotEmpty()) {
                $this->postSearch = NepaliPost::whereIn('en_post_id', $allEnglishPosts->pluck('id'))->get();
                return;
            }
        } elseif (App::getLocale() == 'en') {
            // Search in English posts
            foreach ($searchTerms as $word) {
                $englishPosts[] = EnglishPost::selectRaw(
                    '*, 
                 (CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) AS content_relevance,
                 (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, ""))) AS keywords_relevance,
                 (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, ""))) AS tags_relevance,
                 ((CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) 
                     + (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, "")))
                     + (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, "")))) AS total_relevance',
                    [$word, $word, $word, $word, $word, $word]
                 )
                    ->posts()
                    ->orderByDesc('total_relevance')
                    ->orderBy('created_at', 'desc')
                    ->havingRaw('total_relevance > 0')
                    //->limit(6)
                    ->get();
            }
        
            $allEnglishPosts = collect($englishPosts)->flatten();
        
            // If search term found in English posts, return them
            if ($allEnglishPosts->isNotEmpty()) {
                $this->postSearch = $allEnglishPosts;
                return;
            }
        
            // If not found in English posts, search in Nepali posts
            foreach ($searchTerms as $word) {
                $nepaliPosts[] = NepaliPost::selectRaw(
                    '*, 
                 (CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) AS content_relevance,
                 (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, ""))) AS keywords_relevance,
                 (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, ""))) AS tags_relevance,
                 ((CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) 
                     + (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, "")))
                     + (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, "")))) AS total_relevance',
                    [$word, $word, $word, $word, $word, $word]
                 )
                    ->posts()
                    ->orderByDesc('total_relevance')
                    ->orderBy('created_at', 'desc')
                    ->havingRaw('total_relevance > 0')
                    //->limit(6)
                    ->get();
            }
        
            $allNepaliPosts = collect($nepaliPosts)->flatten();
        
            // If search term found in Nepali posts, check corresponding English posts and return them
            if ($allNepaliPosts->isNotEmpty()) {
                $this->postSearch = EnglishPost::whereIn('np_post_id', $allNepaliPosts->pluck('id'))->get();
                return;
            }
        }
        
        // If no posts found, set postSearch to null
        $this->postSearch = null;
        
    }
    
    public function render()
    {
        return view('livewire.search-engine');
    }
}
