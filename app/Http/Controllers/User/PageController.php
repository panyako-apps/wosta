<?php

namespace App\Http\Controllers\User;

use Share;
use App\Models\Page;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Staff;
use App\Models\Message;
use App\Models\Service;
use App\Models\CoreValue;
use App\Models\Slideshow;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\StaffResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SlideshowResource;
use App\Http\Resources\TestimonialResource;

class PageController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {

        $page = Page::where('name', 'home')->first();
        
        $heroslideshows = SlideshowResource::collection(
            Slideshow::with('slides')->where([
                'isPublished'=> true,
                'position'=> 'homepage-hero-section',
                ])->latest()->get()
        );


        $sitesettings = SiteSetting::where('isPublished', true)->get();
        $services = ServiceResource::collection(Service::where([
            'isPublished' => true,
            'isFeatured' => true,
        ])->get());
        
        $posts = PostResource::collection(Post::with('comments')->where('isPublished', true)->get());
        $testimonials = TestimonialResource::collection(Testimonial::where([
            'isPublished' => true,
            'isFeatured' => true
        ])->get());

        return Inertia::render('Welcome', compact(
            'page', 
            'heroslideshows', 
            'sitesettings', 
            'services', 
            'posts',
            'testimonials'
        ));

    }

    public function about()
    {
        $page = Page::where('name', 'about')->first();

        $sitesettings = SiteSetting::where('isPublished', true)->get();
        $corevalues = CoreValue::where('isPublished', true)->latest()->get();
        $staffMembers = StaffResource::collection(Staff::where('isPublished', true)->get());
        $testimonials = TestimonialResource::collection(Testimonial::where([
            'isPublished' => true,
            'isFeatured' => true
        ])->get());


        return Inertia::render('About', compact('page', 'corevalues', 'sitesettings', 'staffMembers', 'testimonials'));
   
    }

    public function cart(){
        return Inertia::render('Cart/Index');
    }

    public function terms(){

    }

    public function privacy(){
        
    }

    public function contactUs(){
        $messages = Message::all();
        return Inertia::render('Contacts', compact('messages')); 
    }

    public function reviews(){
        $sharelinks =  Share::page(request()->url(), 'User Reviews & Replies')
            ->facebook()
            ->twitter()
            ->whatsapp()
            ->telegram()
            ->linkedin()
            ->getRawLinks();


        return Inertia::render('UserReviews', compact('sharelinks'));
    }
    
}
