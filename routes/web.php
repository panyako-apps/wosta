<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/auth/{provider}/redirect', [App\Http\Controllers\Auth\ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [App\Http\Controllers\Auth\ProviderController::class, 'callback']);


Route::get('/', [App\Http\Controllers\User\PageController::class, 'welcome'])->name('page.welcome');
Route::get('/about-us', [App\Http\Controllers\User\PageController::class, 'about'])->name('page.about');
Route::get('/privacy', [App\Http\Controllers\User\PageController::class, 'privacy'])->name('page.privacy');
Route::get('/terms-of-service', [App\Http\Controllers\User\PageController::class, 'terms'])->name('page.terms');
Route::get('/user-reviews', [App\Http\Controllers\User\PageController::class, 'reviews'])->name('page.reviews');
Route::get('/contact-us', [App\Http\Controllers\User\PageController::class, 'contactUs'])->name('page.contactus');
Route::get('/cart', [App\Http\Controllers\User\PageController::class, 'cart'])->name('page.cart');

// Post 
Route::get('posts', [App\Http\Controllers\User\PostController::class, 'index'])->name('posts.index');
Route::get('post/{slug}', [App\Http\Controllers\User\PostController::class, 'show'])->name('post.show');
Route::get('/post/{user}/userposts', [App\Http\Controllers\User\PostController::class, 'userPosts'])->name('post.userposts');
Route::get('/{id}/posts', [App\Http\Controllers\User\PostController::class, 'categoryIndex'])->name('post.category.index');


// Comments
Route::post('comment/reply', [App\Http\Controllers\User\CommentController::class, 'reply'])->name('comment.reply');


Route::get('services', [App\Http\Controllers\User\ServiceController::class, 'index'])->name('services.index');
Route::get('service/{slug}', [App\Http\Controllers\User\ServiceController::class, 'show'])->name('service.show');

Route::get('/image/{id}/edit', [App\Http\Controllers\User\ImageController::class, 'edit'] )->middleware('auth')->name('image.edit');
Route::delete('/image/{id}', [App\Http\Controllers\User\ImageController::class, 'destroy'] )->middleware('auth')->name('image.destroy');

Route::post('model-view', [App\Http\Controllers\User\ViewController::class, 'store'])->name('model.view.store');
Route::post('model-get-views', [App\Http\Controllers\User\ViewController::class, 'getViews'])->name('model.views.get');


Route::post('/contact-us', [App\Http\Controllers\User\MessageController::class, 'store'])->name('message.store');

Route::get('/request-quote', [App\Http\Controllers\User\QuotationController::class, 'show'])->name('page.requestquote');
Route::post('/save-quote', [App\Http\Controllers\User\QuotationController::class, 'store'])->name('quotation.store');


// Staff Members *
Route::get('/staff', [App\Http\Controllers\User\StaffController::class, 'index'] )->name('staff.index');
Route::get('/staff/{staff}', [App\Http\Controllers\User\StaffController::class, 'show'] )->name('staff.show');


Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'/*'', 'verified'*/])->name('admin.')->group(function(){

    Route::get('dashboard/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::get('dashboard/quotations', [App\Http\Controllers\Admin\AdminController::class, 'quotations'])->name('quotations.index');
    Route::get('dashboard/messages', [App\Http\Controllers\Admin\AdminController::class, 'messages'])->name('messages.index');
    

    //Users
    Route::get('dashboard/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');


    //Slideshows
    Route::get('dashboard/slideshows', [App\Http\Controllers\Admin\SlideshowController::class, 'index'])->name('slideshows.index');
    Route::post('dashboard/slideshows', [App\Http\Controllers\Admin\SlideshowController::class, 'store'])->name('slideshow.store');
    Route::get('dashboard/slideshows/{slug}/manage', [App\Http\Controllers\Admin\SlideshowController::class, 'manage'])->name('slideshow.manage');
    Route::put('dashboard/slideshow/{id}', [App\Http\Controllers\Admin\SlideshowController::class, 'update'] )->name('slideshow.update');
    Route::delete('dashboard/slideshow/{id}/delete', [App\Http\Controllers\Admin\SlideshowController::class, 'destroy'] )->name('slideshow.destroy');
    Route::delete('dashboard/slideshows/delete', [App\Http\Controllers\Admin\SlideshowController::class, 'destroyMultiple'] )->name('slideshow.destroymultiple');
    Route::post('dashboard/slideshows/publish', [App\Http\Controllers\Admin\SlideshowController::class, 'publishMultiple'] )->name('slideshow.publishmultiple');
    Route::post('dashboard/slideshows/unpublish', [App\Http\Controllers\Admin\SlideshowController::class, 'unPublishMultiple'] )->name('slideshow.unpublishmultiple');


    //Slides
    Route::post('dashboard/slides', [App\Http\Controllers\Admin\SlideController::class, 'store'])->name('slide.store');
    Route::put('dashboard/slide/{id}', [App\Http\Controllers\Admin\SlideController::class, 'update'] )->name('slide.update');
    Route::delete('dashboard/slide/{id}/delete', [App\Http\Controllers\Admin\SlideController::class, 'destroy'] )->name('slide.destroy');
    Route::delete('dashboard/slides/delete', [App\Http\Controllers\Admin\SlideController::class, 'destroyMultiple'] )->name('slide.destroymultiple');
    Route::post('dashboard/slides/publish', [App\Http\Controllers\Admin\SlideController::class, 'publishMultiple'] )->name('slide.publishmultiple');
    Route::post('dashboard/slides/unpublish', [App\Http\Controllers\Admin\SlideController::class, 'unPublishMultiple'] )->name('slide.unpublishmultiple');


    // Service Categories
    Route::get('dashboard/service-categories', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'index'])->name('servicecategories.index');
    Route::post('dashboard/service-category/create', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'store'])->name('servicecategory.store');
    Route::put('dashboard/service-category/{id}', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'update'] )->name('servicecategory.update');
    Route::delete('dashboard/service-category/{id}/delete', [App\Http\Controllers\Admin\ServiceCategoryController::class, 'destroy'] )->name('servicecategory.destroy');
    
    
    // Services 
    Route::get('dashboard/services', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('services.index');
    Route::post('dashboard/service/create', [App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('service.store');
    Route::get('dashboard/services/{slug}/manage', [App\Http\Controllers\Admin\ServiceController::class, 'manage'])->name('service.manage');
    Route::put('dashboard/service/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'update'] )->name('service.update');
    Route::post('dashboard/service/upload-images', [App\Http\Controllers\Admin\ServiceController::class, 'uploadImages'])->name('service.images.store');
    Route::delete('dashboard/service/images/{id}/delete', [App\Http\Controllers\Admin\ServiceController::class, 'destroyImage'] )->name('service.image.destroy');
    Route::delete('dashboard/service/images/delete', [App\Http\Controllers\Admin\ServiceController::class, 'destroyImages'] )->name('service.images.destroy');
    Route::put('dashboard/services/images/{id}/update', [App\Http\Controllers\Admin\ServiceController::class, 'updateImage'] )->name('service.image.update');
    Route::delete('dashboard/service/{id}/delete', [App\Http\Controllers\Admin\ServiceController::class, 'destroy'] )->name('service.destroy');
    Route::delete('dashboard/services/delete', [App\Http\Controllers\Admin\ServiceController::class, 'destroyMultiple'] )->name('service.destroymultiple');
    Route::post('dashboard/services/publish', [App\Http\Controllers\Admin\ServiceController::class, 'publishMultiple'] )->name('service.publishmultiple');
    Route::post('dashboard/services/unpublish', [App\Http\Controllers\Admin\ServiceController::class, 'unPublishMultiple'] )->name('service.unpublishmultiple');
    Route::post('dashboard/services/feature', [App\Http\Controllers\Admin\ServiceController::class, 'featureMultiple'] )->name('service.featuremultiple');
    Route::post('dashboard/services/unfeature', [App\Http\Controllers\Admin\ServiceController::class, 'unFeatureMultiple'] )->name('service.unfeaturemultiple');
    Route::post('dashboard/services/assign-category', [App\Http\Controllers\Admin\ServiceController::class, 'assignCategory'] )->name('service.assigncategory');
    

    // Post Categories
    Route::get('dashboard/post-categories', [App\Http\Controllers\Admin\PostCategoryController::class, 'index'])->name('postcategories.index');
    Route::post('dashboard/post-category/create', [App\Http\Controllers\Admin\PostCategoryController::class, 'store'])->name('postcategory.store');
    Route::put('dashboard/post-category/{id}', [App\Http\Controllers\Admin\PostCategoryController::class, 'update'] )->name('postcategory.update');
    Route::delete('dashboard/post-category/{id}/delete', [App\Http\Controllers\Admin\PostCategoryController::class, 'destroy'] )->name('postcategory.destroy');  
   
    
    // Posts 
    Route::get('dashboard/posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('posts.index');
    Route::post('dashboard/post/create', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('post.store');
    Route::get('dashboard/posts/{slug}/manage', [App\Http\Controllers\Admin\PostController::class, 'manage'])->name('post.manage');
    Route::put('dashboard/post/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'] )->name('post.update');
    Route::delete('dashboard/post/images/delete', [App\Http\Controllers\Admin\PostController::class, 'destroyImages'] )->name('post.images.destroy');
    Route::delete('dashboard/post/images/{id}/delete', [App\Http\Controllers\Admin\PostController::class, 'destroyImage'] )->name('post.image.destroy');
    Route::post('dashboard/post/upload-images', [App\Http\Controllers\Admin\PostController::class, 'uploadImages'])->name('post.images.store');
    Route::put('dashboard/posts/images/{id}/update', [App\Http\Controllers\Admin\PostController::class, 'updateImage'] )->name('post.image.update');
    Route::delete('dashboard/post/{id}/delete', [App\Http\Controllers\Admin\PostController::class, 'destroy'] )->name('post.destroy');
        
    Route::post('/image/update', [App\Http\Controllers\Admin\ImageController::class, 'edit'] )->middleware('auth')->name('image.update');
    Route::delete('/image/{id}/delete', [App\Http\Controllers\Admin\ImageController::class, 'destroy'] )->middleware('auth')->name('image.destroy');
    
    
    //Site Settings 
    Route::put('dashboard/sitesettings/{id}/update', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'] )->name('sitesetting.update');
    Route::get('dashboard/site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('sitesettings.index');
    Route::put('dashboard/corevalue/{id}/update', [App\Http\Controllers\Admin\CoreValueController::class, 'update'] )->name('corevalue.update');
    Route::delete('dashboard/corevalue/{id}/delete', [App\Http\Controllers\Admin\CoreValueController::class, 'destroy'])->name('corevalue.destroy');


    // Pages 
    Route::get('dashboard/pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages.index');
    Route::put('dashboard/page/section', [App\Http\Controllers\Admin\PageController::class, 'updateSection'] )->name('page.section.update');
    // Route::post('dashboard/page/create', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('page.store');
    // Route::get('dashboard/pages/{id}/manage', [App\Http\Controllers\Admin\PageController::class, 'manage'])->name('page.manage');
    // Route::put('dashboard/page/{id}', [App\Http\Controllers\Admin\PageController::class, 'update'] )->name('page.update');
    // Route::delete('dashboard/page/{id}/delete', [App\Http\Controllers\Admin\PageController::class, 'destroy'] )->name('page.destroy');
    


    //Staff 
    Route::get('dashboard/staff-members', [App\Http\Controllers\Admin\StaffController::class, 'index'])->name('staffs.index');
    Route::post('/staff', [App\Http\Controllers\Admin\StaffController::class, 'store'] )->name('staff.store');
    Route::get('dashboard/staff-members/{slug}/manage', [App\Http\Controllers\Admin\StaffController::class, 'manage'])->name('staff.manage');
    Route::put('/staff-member/{id}', [App\Http\Controllers\Admin\StaffController::class, 'update'] )->name('staff.update');
    Route::post('dashboard/staff-member/upload-images', [App\Http\Controllers\Admin\StaffController::class, 'uploadImages'])->name('staff.images.store');
    Route::delete('dashboard/staff-member/images/{id}/delete', [App\Http\Controllers\Admin\StaffController::class, 'destroyImage'] )->name('staff.image.destroy');
    Route::delete('dashboard/staff-member/images/delete', [App\Http\Controllers\Admin\StaffController::class, 'destroyImages'] )->name('staff.images.destroy');
    Route::put('dashboard/staff-member/images/{id}/update', [App\Http\Controllers\Admin\StaffController::class, 'updateImage'] )->name('staff.image.update');
    Route::delete('/staff-member/{id}/delete', [App\Http\Controllers\Admin\StaffController::class, 'destroy'] )->name('staff.destroy');
  
  
    //Testimonials 
    Route::get('dashboard/testimonials', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonial', [App\Http\Controllers\Admin\TestimonialController::class, 'store'] )->name('testimonial.store');
    Route::put('/testimonial/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'update'] )->name('testimonial.update');
    Route::delete('/testimonial/{id}/delete', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'] )->name('testimonial.destroy');


});

