<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewPostNotification;

class EnglishPostController extends Controller
{
   public function __construct()
   {
      $this->middleware('permission:add post|update post|delete post|view post', ['only' => ['index']]);
      $this->middleware('permission:delete post', ['only' => ['destroy', 'trash']]);
      $this->middleware('permission:add post|update post', ['only' => ['create', 'store', 'edit', 'update']]);
   }

   public function index()
   {
      $english_posts = EnglishPost::where('status', 1)->orderBy('created_at', 'desc')->get();
      return view('dashboard.post.english.index', [
         'posts' => $english_posts,
      ]);
   }

   // new post creation
   public function create()
   {
      return view('dashboard.post.english.create');
   }
   public function store(Request $request)
   {
      $request->validate([
         'title' => ['required', 'string', 'max_words:9', 'unique:english_posts', 'unique:nepali_posts'],
         'post_id' => ['nullable', 'slug_format', 'english_only'],
         'slug' => ['nullable', 'slug_format', 'english_only', 'unique:nepali_posts', 'unique:english_posts'],
         'feature_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
         'keywords' => ['required'],
         'meta_description' => ['required'],
         'category' => ['required', 'int'],
         'sub_category' => ['nullable', 'en_sub_category'],
         'content' => ['required'],
         'status' => ['required', 'in:0,1']
      ], [
         'post_id.slug_format' => 'Link should be in slug format',
         'slug.slug_format' => 'Invalid format, slug format is required',
         'sub_category.en_sub_category' => 'Invalid sub-category',
         'english_only' => 'English only no other language supported'
      ]);

      $post_id = null;
      $imageName = null;
      $slug = $request->slug;
      if ($request->filled('post_id') || ($request->filled('post_id') && $request->filled('slug'))) {
         $nepali_post = NepaliPost::where('slug', $request->post_id)->first();
         if ($nepali_post) {
            $post_id = $nepali_post->id;
            $slug = null;
         } else {
            return back()->withErrors(['post_id' => 'Invalid post link, please check again'])->withInput();
         }
      } else {
         if (!$slug) {
            $slug = $request->slug ?? Str::slug($request->title);
         }

         if ($request->file('feature_img')) {
            $image = $request->file('feature_img');
            $imageName = 'eng-post' . time() . '.' . $image->extension();
            $image->move(public_path('post_img/english'), $imageName);
            $imageName = 'post_img/english/' . $imageName;
         } else {
            return redirect()->back()->withErrors(['feature_img' => 'Feature image is required'])->withInput();
         }
      }

      EnglishPost::create([
         'author' => Auth::user()->id,
         'title' => $request->title,
         'np_post_id' => $post_id,
         'slug' => $slug,
         'feature_img' => $imageName,
         'keywords' => $request->keywords,
         'tags' => $request->tags,
         'meta_description' => $request->meta_description,
         'category' => $request->category,
         'sub_category' => $request->sub_category,
         'content' => $request->content,
         'status' => $request->status,
      ]);
      // send notification
      $redirect = ($request->status == '1') ? '/post/englishpost' : '/post/englishpost/draft';
      return redirect($redirect)->with([
         'type' => 'success',
         'title' => 'English Post created',
         'message' => 'New post is arrived successfully',
      ]);
   }

   // post update
   public function edit($post)
   {
      $postData = EnglishPost::FindOrFail($post);
      $nepaliPost = NepaliPost::find($postData->np_post_id);
      $link = $slug = null;
      if ($nepaliPost) {
         $link =  $nepaliPost->slug;
      } else {
         $slug =  $postData->slug;
      }
      return view('dashboard.post.english.edit', [
         'post' => $postData,
         'link' => $link,
         'slug' => $slug,
      ]);
   }
   public function update(Request $request, $id)
   {
      $post = EnglishPost::find($id);
      $request->validate([
         'title' => ['required', 'string', 'max_words:9', 'unique:english_posts,id,' . $post->id, 'unique:nepali_posts'],
         'post_id' => ['nullable', 'slug_format', 'english_only', 'unique:english_posts,slug,' . $post->np_post_id],
         'slug' => ['nullable', 'slug_format', 'english_only', 'unique:english_posts,id,' . $post->id],
         'feature_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
         'keywords' => ['required'],
         'meta_description' => ['required'],
         'category' => ['required', 'int'],
         'sub_category' => ['nullable', 'en_sub_category'],
         'content' => ['required'],
         'status' => ['required', 'in:0,1']
      ], [
         'post_id.slug_format' => 'Link should be in slug format',
         'slug.slug_format' => 'Invalid format, slug format is required',
         'sub_category.en_sub_category' => 'Invalid sub-category',
         'english_only' => 'English only no other language supported'
      ]);

      $post_id = null;
      $imageName = null;
      $slug = $request->slug;
      if ($request->filled('post_id') || ($request->filled('post_id') && $request->filled('slug'))) {
         $nepali_post = NepaliPost::where('slug', $request->post_id)->first();;
         if ($nepali_post) {
            $post_id = $nepali_post->id;
            $old_img = $post->feature_img;
            if (File::exists($old_img)) {
               File::delete($old_img);
            }
            $slug = null;
         } else {
            return back()->withErrors(['post_id' => 'Invalid post link, please check again'])->withInput();
         }
      } else {
         if (!$slug) {
            $slug = $request->slug ?? Str::slug($request->title);
         }
         if ($request->file('feature_img')) {
            $old_img = $post->feature_img;
            if (File::exists($old_img)) {
               File::delete($old_img);
            }
            $image = $request->file('feature_img');
            $imageName = 'eng-post' . time() . '.' . $image->extension();
            $image->move(public_path('post_img/english'), $imageName);
            $imageName = 'post_img/english/' . $imageName;
         } else {
            $imageName = $post->feature_img;
         }
      }
      $post->update([
         'title' => $request->title,
         'np_post_id' => $post_id,
         'slug' => $slug,
         'feature_img' => $imageName,
         'keywords' => $request->keywords,
         'tags' => $request->tags,
         'meta_description' => $request->meta_description,
         'category' => $request->category,
         'sub_category' => $request->sub_category,
         'content' => $request->content,
         'status' => $request->status,
      ]);
      $redirect = ($request->status == '1') ? '/post/englishpost' : '/post/englishpost/draft';
      return redirect($redirect)->with([
         'type' => 'success',
         'title' => 'English Post Updated',
         'message' => 'Post is updated successfully',
      ]);
   }

   // delete post
   public function destroy(Request $request, $id)
   {
      $post = EnglishPost::withTrashed()->find($id);
      if ($post->deleted_at) {
         $fileName = basename($post->feature_img);
         $oldImagePath = $post->feature_img;
         $newImagePath = 'post_img/nepali/' . $fileName;
         $nepali_post = NepaliPost::where('en_post_id', $post->id)->first();
         if ($nepali_post) {
            $nepali_post->update([
               'feature_img' =>  $newImagePath,
               'slug' => $post->slug,
            ]);
            if (File::exists($oldImagePath)) {
               File::move($oldImagePath, $newImagePath);
            }
            $post->forceDelete();
         } else {
            $old_img = $post->feature_img;
            if (File::exists($old_img)) {
               File::delete($old_img);
            }
            $post->forceDelete();
         }
      } else {
         $post->delete();
      }
      return redirect('/post/englishpost')->with([
         'type' => 'success',
         'title' => 'English Post Deleted',
         'message' => 'Post is deleted successfully',
      ]);
   }


   // send post to view post
   public function getPost(Request $request, $id, $value)
   {
      $posts = EnglishPost::posts()
         ->where('category', $id)
         ->orderBy('created_at', 'desc')
         ->paginate(19, ['*'],config('app.name'));
      $recommends = EnglishPost::selectRaw(
         '*, 
      (CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) AS content_relevance,
      (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, ""))) AS keywords_relevance,
      (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, ""))) AS tags_relevance,
      ((CHAR_LENGTH(content) - CHAR_LENGTH(REPLACE(content, ?, ""))) 
          + (CHAR_LENGTH(keywords) - CHAR_LENGTH(REPLACE(keywords, ?, "")))
          + (CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ?, "")))) AS total_relevance',
         [$value, $value, $value, $value, $value, $value]
      )
         ->posts()
         ->orderByDesc('total_relevance')
         ->orderBy('created_at', 'desc')
         ->havingRaw('total_relevance > 0')
         ->limit(3)
         ->get();

      $nextId = ($id == 7) ? 1 : ($id + 1);
      $nextCat = EnglishPost::posts()
         ->where('category', $nextId)
         ->orderBy('created_at', 'desc')
         ->take(3)
         ->get();

      return ([
         'posts' => $posts,
         'recomends' => $recommends,
         'nextCat' => $nextCat,
      ]);
   }

   public function show()
   {
      $english_posts = EnglishPost::drafts()
         ->orderBy('created_at', 'desc')->get();
      return view('dashboard.post.english.draft', [
         'posts' => $english_posts,
      ]);
   }
   // trash controller

   public function trash()
   {
      $postData = EnglishPost::onlyTrashed()->get();
      return view('dashboard.post.english.trash', [
         'posts' => $postData,
      ]);
   }
   public function restore($id)
   {
      $post = EnglishPost::onlyTrashed()->find($id);
      $post->restore();
      return redirect('/post/englishpost')->with([
         'type' => 'success',
         'title' => 'Nepali Post Restored',
         'message' => 'Post is Restored successfully',
      ]);
   }
}
