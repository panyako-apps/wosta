<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use App\Models\Slideshow;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;

class SlideController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = Str::slug(Request::input('title')).'-'.time().'.'.$image->extension();
        
            $image->storeAs('slide/coverimage/', $imageName, 'local');
            $image->storeAs('slide/coverimage/', $imageName, 'public');

        }
        else
        {
            $imageName = 'default-coverimage.jpg';
        }


        Slide::create([
            'user_id' => Auth::user()->id,
            'title' => Request::input('title'),
            'slideshow_id' => Request::input('slideshow_id'),
            'description' => Request::input('description'),
            'image' => $imageName,
        ]);
        
        
        $slideshow = Slideshow::find(Request::input('slideshow_id'));

        return redirect()->route('admin.slideshow.manage', $slideshow->slug)->with('success', 'Slide Created Successfully!');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $slide = Slide::where('id', $id)->first();
       
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = Str::slug(Request::input('title')).'-'.time().'.'.$image->extension();
            
            if($slide->image !== 'default-coverimage.jpg'){
                Storage::disk('local')->delete('slide/coverimage/'.$slide->image);
                Storage::disk('public')->delete('slide/coverimage/'.$slide->image);
            }
            
            $image->storeAs('slide/coverimage/', $imageName, 'local');
            $image->storeAs('slide/coverimage/', $imageName, 'public');


        }
        else
        {
            $imageName = $slide->image;
        }



        $slide->update([
            'title' => Request::input('title'),
            'description' => Request::input('description'),
            'image' => $imageName,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ]);
        
    
        return redirect()->route('admin.slideshow.manage', $slide->slideshow->slug)->with('success', 'Slide Created Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slide = Slide::where('id', $id)->first();
        $slide->delete();

        if($slide->image !== 'default-coverimage.jpg'){
            Storage::disk('local')->delete('slide/coverimage/'.$slide->image);
            Storage::disk('public')->delete('slide/coverimage/'.$slide->image);
        }

        return redirect()->back()->with('success', 'Slide Deleted Successfully');

    }

    public function publishMultiple(){


        foreach(Request::input('ids') as $id){

            $slide = Slide::find($id);

            $slide->update([
                'isPublished'=>true,
                'published_by'=>Auth::user()->id,
                'published_at'=>now(),
            ]);
    
        }
        
        return redirect()->back()->with('success', 'Slides Published Successfully');

    }


    public function unPublishMultiple(){


        foreach(Request::input('ids') as $id){

            $slide = Slide::find($id);

            $slide->update([
                'isPublished'=>false,
                'published_by'=>Auth::user()->id,
                'published_at'=>now(),
            ]);
    
        }

        return redirect()->back()->with('success', 'Slides Un-published Successfully');

    }
    

    public function destroyMultiple()
    {
        
        foreach(Request::input('ids') as $id){

            $slide = Slide::find($id);

            if($slide->image !== 'default-coverimage.jpg'){
                Storage::disk('local')->delete('slide/coverimage/'.$slide->image);
                Storage::disk('public')->delete('slide/coverimage/'.$slide->image);
            }
            
            //Check for authorization before delete
            $slide->delete();

        }
        
        return redirect()->back()->with('success', 'Slides Deleted Successfully');
    }

}
