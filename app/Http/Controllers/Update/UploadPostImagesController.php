<?php

namespace App\Http\Controllers\Update;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UploadPostImagesController extends Controller
{
    public function uploadImage(Request $request)
    {
        $image = $request->file('file');
        $imageName = 'post-body' . time() . '.' . $image->extension();
        $image->move(public_path('post_img/body_img'), $imageName);

        return response()->json(['location' => '/post_img/body_img/' . $imageName]);
    }
    public function showImages()
    {
        $imageFiles = scandir(public_path('post_img/body_img'));
        $images = array_diff($imageFiles, ['.', '..']);

        return view('dashboard.post.body-images', compact('images'));
    }
    public function deleteImage(Request $request)
    {
        $imagePath = public_path('post_img/body_img/' . $request->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return redirect()->back()->with([
                'type' => 'success',
                'title' => $request->image.' Deleted',
                'message' => 'image successfully',
             ]);
        }

        return redirect()->back()->with([
            'type' => 'error',
            'title' => $request->image.' unable to delete',
            'message' => 'image delete fail',
         ]);;
    }
}
