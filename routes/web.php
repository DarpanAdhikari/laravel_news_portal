<?php

use App\Http\Controllers\Auth\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Get\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Auth\RedirectController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\EnglishPostController;
use App\Http\Controllers\Get\HashTagController;
use App\Http\Controllers\Get\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NepaliPostController;
use App\Http\Controllers\StyleCssController;
use App\Http\Controllers\Update\ChangeUserRoleStatus;
use App\Http\Controllers\Update\EditPageContentController;
use App\Http\Controllers\Update\UpdateSocialAndLogoController;
use App\Http\Controllers\Update\UploadPostImagesController;
use App\Http\Controllers\Update\VerifySubscriberController;
use App\Livewire\Chat\Index;
use App\Livewire\Chat\Inbox;

Route::get('/', [HomeController::class,"HomeContent"])->name('home');
Route::post('/lang/change', [LanguageController::class, 'LangChange'])->name('lang');
Route::get('subscribe/{token}',[VerifySubscriberController::class,'verifySubscriber']);
Route::get('unsubscribe/{id}',[VerifySubscriberController::class,'unSubscribe']);

Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::get('roles/{role}/add-permission', [RoleController::class, 'addPermissionToRole']);
Route::post('roles/{role}/add-permission', [RoleController::class, 'providePermission']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::view('/dashboard', 'dashboard.analysist')->name('dashboard')->middleware('hasAnyPermission');
    Route::get('/redirect', [RedirectController::class, 'redirect'])->name('redirect');

    Route::prefix('post')->group(function () {
        Route::resource('nepalipost', NepaliPostController::class);
        Route::get('/nptrash', [NepaliPostController::class,'trash']);
        Route::get('nepalipost/{id}/restore', [NepaliPostController::class,'restore']);
        Route::resource('englishpost', EnglishPostController::class);
        Route::get('/entrash', [EnglishPostController::class,'trash']);
        Route::get('englishpost/{id}/restore', [EnglishPostController::class,'restore']);

        Route::post('body_img',[UploadPostImagesController::class,'uploadImage'])->name('upload.image');
        Route::get('body_img/show',[UploadPostImagesController::class,'showImages'])->name('get.image');
        Route::post('delete_body_img',[UploadPostImagesController::class,'deleteImage'])->name('delete.image');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('userTable', [UserController::class, 'getUsers'])->name('user.table')->middleware('permission:change role|block/unblock|view users');
        Route::get('customize/edit/page-social', [UpdateSocialAndLogoController::class,'logoShow'])->name('customize.page_info')->middleware('permission:change on page|view page content');
        Route::post('customize/edit/page-social', [UpdateSocialAndLogoController::class,'updateSocial'])->name('customize.page_social')->middleware('permission:change on page');
        Route::post('customize/edit/page-logo', [UpdateSocialAndLogoController::class,'updateLogo'])->name('customize.page_logo')->middleware('permission:change on page');
        Route::get('customize/edit/page-content', [EditPageContentController::class, 'index'])->name('customize.page_content')->middleware('permission:change on page|view page content');
        Route::get('customize/styleCss', [StyleCssController::class, 'getCSS'])->name('customize.style')->middleware('permission:change css code');
        Route::post('customize/edit/styleCss', [StyleCssController::class, 'createOrUpdateCSS'])->name('customize.style.upload')->middleware('permission:change css code');
    });

    Route::get('dashboard/{id}/{action}', [ChangeUserRoleStatus::class, 'statusUpdate'])->where('action', 'ban|unban')->middleware('permission:block/unblock');
    Route::post('/change/user-Role', [ChangeUserRoleStatus::class, 'changeRole'])->name('change-role')->middleware('permission:change role');
    Route::get('/role/{role}/edit', [ChangeUserRoleStatus::class, 'edit'])->middleware('permission:change role');
    Route::post('/localization/update', [EditPageContentController::class, 'update'])->name('localization.update')->middleware('permission:change on page');

    Route::get('/chat',Index::class)->name('chat.index');
    Route::get('/chat/{id}', Index::class)->where('id', '.*')->name('inbox');
});

// authentication provider
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);
// general page routes
Route::get('/content/{slug}', [HashTagController::class,'content'])->where('slug', '.*')->name('content.page');
Route::get('/hashtag/{slug}', [HashTagController::class,'hashtag'])->where('slug', '.*')->name('hashtag.page');
Route::view('/mainpage', 'pages.mainpage')->name('main.page');
Route::get('/our-team', [UserController::class, 'ourTeams'])->name('our.team');

// routes for reading random request for information

Route::get('/{search}', [SearchController::class, 'search'])->where('search', '.*');
Route::fallback(function () {
    return view('errors.404');
});
