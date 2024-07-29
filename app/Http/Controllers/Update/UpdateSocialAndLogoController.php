<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UpdateSocialAndLogoController extends Controller
{
    public function updateSocial(Request $request)
    {
        $validatedData = $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);
        $facebook = $validatedData['facebook'];
        $twitter = $validatedData['twitter'];
        $instagram = $validatedData['instagram'];
        $youtube = $validatedData['youtube'];

        // Update the JSON files
        $enFilePath = base_path('lang/en.json');
        $npFilePath = base_path('lang/np.json');

        $enData = json_decode(File::get($enFilePath), true);
        $npData = json_decode(File::get($npFilePath), true);

        $enData['facebook'] = $facebook;
        $enData['twitter'] = $twitter;
        $enData['instagram'] = $instagram;
        $enData['youtube'] = $youtube;

        $npData['facebook'] = $facebook;
        $npData['twitter'] = $twitter;
        $npData['instagram'] = $instagram;
        $npData['youtube'] = $youtube;

        File::put($enFilePath, json_encode($enData, JSON_PRETTY_PRINT));
        File::put($npFilePath, json_encode($npData, JSON_PRETTY_PRINT));

        return redirect()->back()->with([
            'type' => 'success',
            'title' => 'Congrats from ' . config('app.name'),
            'message' => "Social links has been changed",
        ]);
    }

    // for logo update
    public function logoShow()
    {
        $logoImages = Storage::files('public/logos/logo');
        $logoNameImages = Storage::files('public/logos/logo-name');
        $logoImageUrls = array_map(function ($path) {
            return url(Storage::url($path));
        }, $logoImages);

        $logoNameImageUrls = array_map(function ($path) {
            return url(Storage::url($path));
        }, $logoNameImages);

        return view('dashboard.page_social', [
            'logoImageUrls' => $logoImageUrls,
            'logoNameImageUrls' => $logoNameImageUrls,
        ]);
    }
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo_name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size set to 2MB
            'logo_only' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size set to 2MB
        ]);
        $siteName = config('app.name');

        if ($request->hasFile('logo_name') && $request->hasFile('logo_only')) {
            Storage::disk('public')->deleteDirectory('logos');
            Storage::disk('public')->makeDirectory('logos/logo_name');

            $logoNameFile = $request->file('logo_name');
            $logoOnlyFile = $request->file('logo_only');

            $logoNameFilename = 'logo.' . $siteName . '.' . $logoNameFile->getClientOriginalExtension();
            $logoOnlyFilename = $siteName . '.logo.' . $logoOnlyFile->getClientOriginalExtension();
            $storedLogoNamePath = $logoNameFile->storeAs('logos/logo-name', $logoNameFilename, 'public');
            $storedLogoOnlyPath = $logoOnlyFile->storeAs('logos/logo', $logoOnlyFilename, 'public');

            return redirect()->back()->with([
                'type' => 'success',
                'title' => 'Congrats from ' . config('app.name'),
                'message' => "Congratulation logos are updated",
            ]);;
        }
    }
}
