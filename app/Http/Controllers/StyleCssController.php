<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StyleCssController extends Controller
{
    public function createOrUpdateCSS(Request $request)
    {
        $cssContent = $request->input('css_content');
        $path = public_path('asset\css\custom.css');

        File::put($path, $cssContent);

        return back()->with([
            'type' => 'success',
            'title' => 'Css Changes',
            'message' => 'Site css is changes successfully',
         ]);;
    }

    public function getCSS()
    {
        $path = public_path('asset\css\custom.css');
        $cssContent = File::get($path);
        return view('dashboard.StyleCss',['css_content' => $cssContent]);
    }
}
