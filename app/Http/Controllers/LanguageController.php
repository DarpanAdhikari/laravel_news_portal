<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function LangChange(Request $request)
    {
        $languageCode = $request->input('lang');
        if ($languageCode == 'en' || $languageCode == 'np') {
            session(['locale' => $languageCode]);
            if (!session('locale')) {
                return back()->with([
                    'type' => 'error',
                    'title' => 'Alert from' . config('app.name'),
                    'message' => 'Sorry, we are unable to change language',
                ]);
            }
            return back();
        } else {
            return back()->with([
                'type' => 'error',
                'title' => 'Alert from' . config('app.name'),
                'message' => 'Sorry, we are unable to change language',
            ]);
        }
    }
}
