<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Image;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TestimonialResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{


    public function index()
    {        
        $testimonials = TestimonialResource::collection(Testimonial::latest()->paginate(20));
        return Inertia::render('Dashboard/Testimonial/Index', compact('testimonials'));
    }


    public function store(Request $request)
    {

        $slug = Str::slug(Request::input('name')).time();
 
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'.'.$image->extension();
            $image->storeAs('testimonial/profileimage/', $imageName, 'local');
            $image->storeAs('testimonial/profileimage/', $imageName, 'public');
        }
        else
        {
            $imageName = 'default-profileimage.jpg';
        }

        Auth::user()->testimonials()->create([
            'name'=>Request::input('name'),
            'title'=>Request::input('title'),
            'job_title'=>Request::input('job_title'),
            'testimony'=>Request::input('testimony'),
            'image'=>$imageName,
        ]);

        return redirect()->back()->with('success', 'Testimonial Created Successfully');
        
    }
    
    public function update($id)
    {
        $testimonial = Testimonial::find($id);

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = Str::slug(Request::input('name')).'-'.time().'.'.$image->extension();
            
            //Delete the old Images 
            if($testimonial->image !== 'default-profileimage.jpg'){
                Storage::disk('local')->delete('testimonial/profileimage/'.$testimonial->image);
                Storage::disk('public')->delete('testimonial/profileimage/'.$testimonial->image);
            }
            //Store New Image
            $image->storeAs('testimonial/profileimage/', $imageName, 'local');
            $image->storeAs('testimonial/profileimage/', $imageName, 'public');


        }
        else
        {
            $imageName = $testimonial->image;
        }

        $testimonial->update([
            'name'=>Request::input('name'),
            'title'=>Request::input('title'),
            'job_title'=>Request::input('job_title'),
            'testimony'=>Request::input('testimony'),
            'image'=>$imageName,
        ]);

        return redirect()->back()->with('success', 'Testimonial Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        //Check for authorization before delete
        $testimonial->delete();
        
        if($testimonial->image !== 'default-profileimage.jpg'){
            Storage::disk('local')->delete('testimonial/profileimage/'.$testimonial->image);
            Storage::disk('public')->delete('testimonial/profileimage/'.$testimonial->image);
        }
        return redirect()->back()->with('success', 'Testimonial Deleted Successfully');

    }

}
