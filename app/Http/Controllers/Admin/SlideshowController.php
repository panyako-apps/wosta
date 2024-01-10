<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Slideshow;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\SlideshowResource;
use App\Http\Requests\StoreSlideshowRequest;
use App\Http\Requests\UpdateSlideshowRequest;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slideshows = Slideshow::all();
        return Inertia::render('Dashboard/Slideshow/Index', compact('slideshows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(Request::all());
        $slug = Str::slug(Request::input('name')).time();

        $slideshow = Slideshow::create([
            'user_id' => Auth::user()->id,
            'name' => Request::input('name'),
            'position' => Request::input('position'),
            'description' => Request::input('description'),
            'slug' => $slug
        ]);

        return redirect()->route('admin.slideshows.index')->With('success', 'Slideshow Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slideshow $slideshow)
    {
        $slideshow = Slideshow::where('slug', $slug)->first()->load('slides');
        return Inertia::render('Dashboard/Slideshow/Show', compact('slideshow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $slideshow = Slideshow::where('slug', $slug)->first();
        return Inertia::render('Dashboard/Slideshow/Edit', compact('slideshow'));
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function manage($slug)
    {
  
        $slideshow = SlideshowResource::make(Slideshow::with([
            'slides' => function($query){
                $query->latest();
            }
        ])->where('slug', $slug)->first());
        
        return Inertia::render('Dashboard/Slideshow/Manage', compact('slideshow'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {

        $slideshow = Slideshow::where('slug', $slug)->first();
        $slug = Str::slug(Request::input('name')).time();
        
        $slideshow->update([
            'name' => Request::input('name'),
            'position' => Request::input('position'),
            'description' => Request::input('description'),
            'slug' => $slug,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.slideshows.index')->with('success', 'Slideshow Created Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slideshow = Slideshow::where('id', $id)->first();
        $slideshow->delete();
    }


    public function publishMultiple(){


        foreach(Request::input('ids') as $id){

            $slideshow = Slideshow::find($id);

            $slideshow->update([
                'isPublished'=>true,
                'published_by'=>Auth::user()->id,
                'published_at'=>now(),
            ]);
    
        }
        
        return redirect()->back()->with('success', 'Slideshows Published Successfully');

    }


    public function unPublishMultiple(){


        foreach(Request::input('ids') as $id){

            $slideshow = Slideshow::find($id);

            $slideshow->update([
                'isPublished'=>false,
                'published_by'=>Auth::user()->id,
                'published_at'=>now(),
            ]);
    
        }

        return redirect()->back()->with('success', 'Slideshows Un-published Successfully');

    }
    

    public function destroyMultiple()
    {
        
        foreach(Request::input('ids') as $id){

            $slideshow = Slideshow::find($id);

            //Check for authorization before delete
            $slideshow->delete();

        }
        
        return redirect()->back()->with('success', 'Slideshows Deleted Successfully');
    }

}
