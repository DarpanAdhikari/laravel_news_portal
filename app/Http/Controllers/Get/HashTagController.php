<?php

namespace App\Http\Controllers\Get;

use Carbon\Carbon;
use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

class HashTagController extends Controller
{
   public function content($content)
   {
      if ($this->translation($content)) {
         return view('pages.content', [
            'search' => $content,
            'posts' => $this->translation($content),
         ]);
      } else {
         return view('pages.content', [
            'search' => $content,
            'posts' => $this->getPost($content),
         ]);
      }
   }
   public function hashtag($hashtag)
   {
      if ($this->translation($hashtag)) {
         return view('pages.content', [
            'search' => $hashtag,
            'posts' => $this->translation($hashtag),
         ]);
      } else {
         return view('pages.content', [
            'search' => $hashtag,
            'posts' => $this->getPost($hashtag),
         ]);
      }
   }

   private function translation($searchTerm)
   {
      $enJsonContent = File::get(base_path('lang/en.json'));
      $enData = json_decode($enJsonContent, true);
      $npJsonContent = File::get(base_path('lang/np.json'));
      $npData = json_decode($npJsonContent, true);
      $searchPath = ['footerNav'];
      $enTranslation = $this->findTranslationAndPosition($enData, $npData, $searchTerm, $searchPath);
      if ($enTranslation !== null  && (App::getLocale() == 'np')) {
         return $this->getPost($enTranslation);
      } else {
         $npTranslation = $this->findTranslationAndPosition($npData, $enData, $searchTerm, $searchPath);
         if ($npTranslation !== null && (App::getLocale() == 'en')) {
            return $this->getPost($npTranslation);
         } else {
            return null;
         }
      }
   }

   private function findTranslationAndPosition($searchArray, $compareArray, $searchTerm, $searchPath, $path = "")
   {
      foreach ($searchPath as $key) {
         $searchArray = $searchArray[$key];
         $compareArray = $compareArray[$key];
      }
      foreach ($searchArray as $key => $subValue) {
         if (is_array($subValue)) {
            $result = $this->findTranslationAndPosition($subValue, $compareArray[$key], $searchTerm, [], $path . "['$key']");
            if ($result !== null) {
               return $result;
            }
         } elseif (strcasecmp($subValue, $searchTerm) === 0) {
            return $compareArray[$key];
         }
      }

      return null;
   }
   private function getPost($search)
   {
      $symbolsToReplace = ['/', '?', '=', '&', '+', '-', '_', '.', ',', ':', ';', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')'];
      $searchTerm = explode(' ', str_replace($symbolsToReplace, ' ', $search));

      foreach ($searchTerm as $value) {
         $nepaliPosts = NepaliPost::posts()
         ->where('sub_category', $value)
         ->orWhere('title', 'like', '%' . $value . '%')
         ->orWhere('keywords', 'like', '%' . $value . '%')
         ->orWhere('meta_description', 'like', '%' . $value . '%')
         ->orWhere('content', 'like', '%' . $value . '%')
         ->orderByRaw("CASE WHEN sub_category = '$value' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN title LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN keywords LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN meta_description LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN content LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->paginate(19, ['*'],config('app.name'));

         $englishPosts = EnglishPost::posts()
         ->where('sub_category', $value)
         ->orWhere('title', 'like', '%' . $value . '%')
         ->orWhere('keywords', 'like', '%' . $value . '%')
         ->orWhere('meta_description', 'like', '%' . $value . '%')
         ->orWhere('content', 'like', '%' . $value . '%')
         ->orderByRaw("CASE WHEN sub_category = '$value' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN title LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN keywords LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN meta_description LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->orderByRaw("CASE WHEN content LIKE '%$value%' THEN 1 ELSE 0 END DESC")
         ->paginate(19, ['*'],config('app.name'));
      }

      if (App::getLocale() == 'en') {
         return $englishPosts;
      } elseif (App::getLocale() == 'np') {
         return $nepaliPosts;
      } else {
         return null;
      }
   }
}
