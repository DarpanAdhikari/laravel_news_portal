<?php

namespace App\Http\Controllers\Get;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\NepaliPostController;
use App\Http\Controllers\EnglishPostController;

class SearchController extends Controller
{
    public function search($searchTerm)
    {
        $symbolsToReplace = ['/', '?', '=', '&', '+', '-', '_', '.', ',', ':', ';', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')'];
        $searched = str_replace($symbolsToReplace,' ', $searchTerm);

        $enJsonContent = File::get(base_path('lang/en.json'));
        $enData = json_decode($enJsonContent, true);
        $npJsonContent = File::get(base_path('lang/np.json'));
        $npData = json_decode($npJsonContent, true);
        $searchPath = ['navigation', 'name'];
        $enTranslation = $this->findTranslationAndPosition($enData, $npData, $searchTerm, $searchPath);
        if ($enTranslation !== null) {
            $controller = (App::getLocale() == 'np') ? NepaliPostController::class : EnglishPostController::class;
            $response = app()->call($controller.'@getPost', ['id' => $enTranslation['position'],'value'=>$searchTerm]);
            return view('pages.mainpage',[
                'position'=>$enTranslation['position'],
                'response'=>$response,
            ]);
        } else {
            $npTranslation = $this->findTranslationAndPosition($npData, $enData, $searchTerm, $searchPath);
            if ($npTranslation !== null) {
                $controller = (App::getLocale() == 'np') ? NepaliPostController::class : EnglishPostController::class;
                $response = app()->call($controller.'@getPost', ['id' => $npTranslation['position'],'value'=>$searchTerm]);
                return view('pages.mainpage',[
                    'position'=>$npTranslation['position'],
                    'response'=>$response,
                ]);
            } else {
               $response = app()->call(SearchPostController::class.'@SearchPost',['searchValue'=>$searchTerm]);
               return view('pages.read_post',[
                'search'=>$searched,
                'response'=>$response,
               ]);
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
                return ['translation' => $compareArray[$key], 'position' => $path . "$key"];
            }
        }

        return null;
    }
}
