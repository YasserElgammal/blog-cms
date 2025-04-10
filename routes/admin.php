<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'can:admin-login'])->name('admin.')->prefix('/admin')->group(function () {
    // This Roles can manage with Admin & Writers with specific policies.
    Route::get('/', AdminController::class)->name('index');
    Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
    Route::get('/post/slug-get', [PostController::class, 'getSlug'])->name('post.getslug');
    Route::resources([
        'post' => PostController::class,
        'tag' => TagController::class,
    ]);
    Route::resource('/account', AccountController::class, ['only' => ['index', 'update']]);
    // Special To Admin Role Only
    Route::middleware(['can:admin-only'])->group(function () {
        Route::get('/category/slug-get', [CategoryController::class, 'getSlug'])->name('category.getslug');
        Route::get('/page/slug-get', [PageController::class, 'getSlug'])->name('page.getslug');
        Route::resource('/category', CategoryController::class);
        Route::resource('/user', UserController::class, ['except' => ['create', 'store', 'show']]);
        Route::resource('/page', PageController::class);
        Route::resource('/role', RoleController::class, ['only' => ['index']]);
        Route::resource('/setting', SettingController::class, ['only' => ['index', 'update']]);
    });
});
