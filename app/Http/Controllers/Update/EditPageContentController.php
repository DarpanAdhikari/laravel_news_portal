<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EditPageContentController extends Controller
{
    public function index()
    {
        $enContent = json_decode(File::get(base_path('lang/en.json')), true);
        $npContent = json_decode(File::get(base_path('lang/np.json')), true);
        $editableEnContent = [
            'site-name' => $enContent['site-name'],
            'aboutSiteOwner' => $enContent['aboutSiteOwner'],
            'navigation' => $enContent['navigation'],
            'hype-topics' => $enContent['hype-topics'],
            'footerNav' => $enContent['footerNav'],
            'categories' => $enContent['categories'],
            'aboutSiteLink' => $enContent['aboutSiteLink'],
            'time' => $enContent['time'],
        ];

        $editableNpContent = [
            'site-name' => $npContent['site-name'],
            'aboutSiteOwner' => $npContent['aboutSiteOwner'],
            'navigation' => $npContent['navigation'],
            'hype-topics' => $npContent['hype-topics'],
            'footerNav' => $npContent['footerNav'],
            'categories' => $npContent['categories'],
            'aboutSiteLink' => $npContent['aboutSiteLink'],
            'time' => $npContent['time'],
        ];

        return view('dashboard.page_content', compact('editableEnContent', 'editableNpContent'));
    }
    public function update(Request $request)
    {
        $enContent = json_decode(File::get(base_path('lang/en.json')), true);
        $npContent = json_decode(File::get(base_path('lang/np.json')), true);

        function compareStructure($data1, $data2) {
            if (gettype($data1) !== gettype($data2)) {
                return false;
            }
            
            if (is_array($data1)) {
                if (count($data1) !== count($data2)) {
                    return false;
                }
                
                foreach ($data1 as $key => $value) {
                    if (!isset($data2[$key])) {
                        return false;
                    }
                    
                    if (!compareStructure($value, $data2[$key])) {
                        return false;
                    }
                }
            } elseif (is_object($data1)) {
                if (count((array) $data1) !== count((array) $data2)) {
                    return false;
                }
                
                foreach ($data1 as $key => $value) {
                    if (!isset($data2->$key)) {
                        return false;
                    }
                    
                    if (!compareStructure($value, $data2->$key)) {
                        return false;
                    }
                }
            }
            
            return true;
        }
        
         foreach ($request->input('en_content') as $key => $value) {
        $jsonValue = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (compareStructure($jsonValue, $enContent[$key])) {
                $enContent[$key] = $jsonValue;
            } else {
                return back()->with([
                    'type' => 'error',
                    'title'=> 'Error from '.config('app.name'),
                    'message'=> "Error: original structure did not match '$key'.",
                ]);
            }
        } else {
            $enContent[$key] = $value;
        }
    }
    
    foreach ($request->input('np_content') as $key => $value) {
        $jsonValue = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (compareStructure($jsonValue, $npContent[$key])) {
                $npContent[$key] = $jsonValue;
            } else {
                return back()->with([
                    'type' => 'error',
                    'title'=> 'Error from '.config('app.name'),
                    'message'=> "Error: Invalid structure for key '$key'.",
                ]);
            }
        } else {
            $npContent[$key] = $value;
        }
    }
        
        File::put(base_path('lang/en.json'), json_encode($enContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        File::put(base_path('lang/np.json'), json_encode($npContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
        return back()->with([
            'type' => 'success',
            'title'=> 'Congrats from '.config('app.name'),
            'message'=> "Congratulation your submission is updated successfully",
        ]);
    }
    
}
