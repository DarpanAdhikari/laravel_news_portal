<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NepaliPost;
use App\Models\EnglishPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NepaliPostController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:add post|update post|delete post|view post', ['only' => ['index']]);
    $this->middleware('permission:delete post', ['only' => ['destroy', 'trash']]);
    $this->middleware('permission:add post|update post', ['only' => ['create', 'store', 'edit', 'update']]);
  }
  public function index()
  {
    $nepali_posts = NepaliPost::where('status', 1)->orderBy('created_at', 'desc')->get();
    return view('dashboard.post.nepali.index', [
      'posts' => $nepali_posts,
    ]);
  }

  // new post creation
  public function create()
  {
    return view('dashboard.post.nepali.create');
  }
  public function store(Request $request)
  {
    $request->validate([
      'title' => ['required', 'string', 'max_words:9', 'unique:english_posts', 'unique:nepali_posts'],
      'post_id' => ['nullable', 'slug_format', 'english_only', 'required_without:slug'],
      'slug' => ['nullable', 'slug_format', 'english_only', 'required_without:post_id', 'unique:nepali_posts', 'unique:english_posts'],
      'feature_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024', 'required_with:slug'],
      'keywords' => ['required'],
      'meta_description' => ['required'],
      'category' => ['required', 'int'],
      'sub_category' => ['nullable', 'np_sub_category'],
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
      $english_post = EnglishPost::where('slug', $request->post_id)->first();
      if ($english_post) {
        $post_id = $english_post->id;
        $slug = null;
      } else {
        return back()->withErrors(['post_id' => 'Invalid post link, please check again'])->withInput();
      }
    } else {
      if ($request->file('feature_img')) {
        $image = $request->file('feature_img');
        $imageName = 'np-post' . time() . '.' . $image->extension();
        $image->move(public_path('post_img/nepali'), $imageName);
        $imageName = 'post_img/nepali/' . $imageName;
      }
    }
    NepaliPost::create([
      'author' => Auth::user()->id,
      'title' => $request->title,
      'en_post_id' => $post_id,
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
    $redirect = ($request->status == '1') ? '/post/nepalipost' : '/post/nepalipost/draft';
    return redirect($redirect)->with([
      'type' => 'success',
      'title' => 'English Post created',
      'message' => 'New post is arrived successfully',
    ]);
  }
  // post update
  public function edit($post)
  {
    $postData = NepaliPost::FindOrFail($post);
    $englishPost = EnglishPost::find($postData->en_post_id);
    $link = $slug = null;
    if ($englishPost) {
      $link =  $englishPost->slug;
    } else {
      $slug =  $postData->slug;
    }
    return view('dashboard.post.nepali.edit', [
      'post' => $postData,
      'link' => $link,
      'slug' => $slug,
    ]);
  }
  public function update(Request $request, $id)
  {
    $post = NepaliPost::find($id);
    $request->validate([
      'title' => ['required', 'string', 'max_words:9', 'unique:nepali_posts,id,' . $post->id, 'unique:english_posts'],
      'post_id' => ['nullable', 'slug_format', 'english_only', 'required_without:slug', 'unique:english_posts,slug,' . $post->en_post_id],
      'slug' => ['nullable', 'slug_format', 'english_only', 'required_without:post_id', 'unique:english_posts', 'unique:nepali_posts,id,' . $post->id],
      'feature_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
      'keywords' => ['required'],
      'meta_description' => ['required'],
      'category' => ['required', 'int'],
      'sub_category' => ['nullable', 'np_sub_category'],
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
      $english_post = EnglishPost::where('slug', $request->post_id)->first();;
      if ($english_post) {
        $post_id = $english_post->id;
        $old_img = $post->feature_img;
        if (File::exists($old_img)) {
          File::delete($old_img);
        }
        $slug = null;
      } else {
        return back()->withErrors(['post_id' => 'Invalid post link, please check again'])->withInput();
      }
    } else {
      if ($request->file('feature_img')) {
        $old_img = $post->feature_img;
        if (File::exists($old_img)) {
          File::delete($old_img);
        }
        $image = $request->file('feature_img');
        $imageName = 'np-post' . time() . '.' . $image->extension();
        $image->move(public_path('post_img/nepali'), $imageName);
        $imageName = 'post_img/nepali/' . $imageName;
      } else {
        $imageName = $post->feature_img;
      }
    }

    $post->update([
      'title' => $request->title,
      'post_id' => $post_id,
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
    $redirect = ($request->status == '1') ? '/post/nepalipost' : '/post/nepalipost/draft';
    return redirect($redirect)->with([
      'type' => 'success',
      'title' => 'Nepali Post Updated',
      'message' => 'Post is Updated successfully',
    ]);
  }

  // delete post
  public function destroy(Request $request, $id)
  {
    $post = NepaliPost::withTrashed()->find($id);
    if ($post->deleted_at) {
      $fileName = basename($post->feature_img);
      $oldImagePath = $post->feature_img;
      $newImagePath = 'post_img/english/' . $fileName;
      $english_post = EnglishPost::where('np_post_id', $post->id)->first();
      if ($english_post) {
        $english_post->update([
          'feature_img' => $newImagePath,
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
    return redirect('/post/nepalipost')->with([
      'type' => 'success',
      'title' => 'Nepali Post Deleted',
      'message' => 'Post is deleted successfully',
    ]);
  }

  // send post to view
  public function getPost(Request $request, $id, $value)
  {
    $posts = NepaliPost::posts()
      ->where('category', $id)
      ->orderBy('created_at', 'desc')
      ->paginate(19, ['*'],config('app.name'));

    $recommends = NepaliPost::selectRaw(
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
    $nextCat = NepaliPost::posts()
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
    $nepali_posts = NepaliPost::where('status', 0)->orderBy('created_at', 'desc')->get();
    return view('dashboard.post.nepali.draft', [
      'posts' => $nepali_posts,
    ]);
  }

  // trash controller
  public function trash()
  {
    $postData = NepaliPost::onlyTrashed()->get();
    return view('dashboard.post.nepali.trash', [
      'posts' => $postData,
    ]);
  }
  public function restore($id)
  {
    $post = NepaliPost::onlyTrashed()->find($id);
    $post->restore();
    return redirect('/post/nepalipost')->with([
      'type' => 'success',
      'title' => 'Nepali Post Restored',
      'message' => 'Post is Restored successfully',
    ]);
  }
}
