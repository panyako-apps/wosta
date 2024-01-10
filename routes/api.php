<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('site-settings', [App\Http\Controllers\Api\SiteSettingController::class, 'index']);
Route::get('site-images', [App\Http\Controllers\Api\ImageController::class, 'index']);
Route::get('site-ratings', [App\Http\Controllers\Api\SiteRatingController::class, 'index']);

Route::get('all-services', [App\Http\Controllers\Api\ServiceController::class, 'index']);
Route::get('featured-services', [App\Http\Controllers\Api\ServiceController::class, 'featured']);
Route::get('published-services', [App\Http\Controllers\Api\ServiceController::class, 'published']);
Route::get('filtered-services/{id}', [App\Http\Controllers\Api\ServiceController::class, 'filtered']);


Route::get('posts', [App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('published-posts', [App\Http\Controllers\Api\PostController::class, 'published']);
Route::get('featured-posts', [App\Http\Controllers\Api\PostController::class, 'featured']);
Route::get('related-posts/{post_id}/{category_id}', [App\Http\Controllers\Api\PostController::class, 'related']);
Route::get('filtered-posts/{id}', [App\Http\Controllers\Api\PostController::class, 'filtered']);

Route::get('service-categories', [App\Http\Controllers\Api\ServiceCategoriesController::class, 'index']);

Route::post('likes', [App\Http\Controllers\Api\LikeController::class, 'index'])->name('api.likes');
Route::post('like', [App\Http\Controllers\Api\LikeController::class, 'store'])->name('api.like');

Route::post('publish-model', [App\Http\Controllers\Api\PublishModelController::class, 'store'])->name('model.publish');
Route::post('model-published-status', [App\Http\Controllers\Api\PublishModelController::class, 'index'])->name('model.getispublished');


Route::post('feature-model', [App\Http\Controllers\Api\FeatureModelController::class, 'store'])->name('model.feature');
Route::post('model-featured-status', [App\Http\Controllers\Api\FeatureModelController::class, 'index'])->name('model.getisfeatured');


Route::post('comments', [App\Http\Controllers\Api\CommentController::class, 'index'])->name('api.comments.index');
Route::post('comment', [App\Http\Controllers\Api\CommentController::class, 'store'])->name('api.comment.store');
Route::delete('comment/{id}/destroy', [App\Http\Controllers\Api\CommentController::class, 'destroy'])->name('api.comment.destroy');
Route::put('comment/{id}/update', [App\Http\Controllers\Api\CommentController::class, 'update'])->name('api.comment.update');


Route::post('images', [App\Http\Controllers\Api\ImageController::class, 'index'])->name('api.images.index');


Route::post('model-views', [App\Http\Controllers\Api\ViewController::class, 'index'])->name('api.views.index');