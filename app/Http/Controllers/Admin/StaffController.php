<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Inertia\Inertia;
use App\Models\Image;
use App\Models\Staff;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StaffResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{


    public function index()
    {
        $roles = Role::all();
        
        $staffMembers = StaffResource::collection(Staff::latest()->paginate(20));
        return Inertia::render('Dashboard/Staff/Index', compact('staffMembers', 'roles'));
    }


    public function store(Request $request)
    {
 
        $slug = Str::slug(Request::input('name')).time();
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'.'.$image->extension();
            $image->storeAs('staff/profileimage/', $imageName, 'local');
            $image->storeAs('staff/profileimage/', $imageName, 'public');
        }
        else
        {
            $imageName = 'default-profileimage.jpg';
        }

        Auth::user()->staffMembers()->create([
            'name'=>Request::input('name'),
            'email'=>Request::input('email'),
            'slug'=> $slug,
            'title'=>Request::input('title'),
            'description'=>Request::input('description'),
            'image'=>$imageName,
            'job_title'=>Request::input('job_title'),
        ]);

        return redirect()->back()->with('success', 'Staff Created Successfully');
        
    }

    public function manage($slug){
        $staff = new StaffResource(Staff::where('slug', $slug)->firstOrFail());
        $roles = Role::all();
        return Inertia::render('Dashboard/Staff/Manage', compact('staff', 'roles'));
    }

    public function update($id)
    {
        $staff = Staff::find($id);

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = Str::slug(Request::input('name')).'-'.time().'.'.$image->extension();
            
            //Delete the old Images 
            if($staff->image !== 'default-profileimage.jpg'){
                Storage::disk('local')->delete('staff/profileimage/'.$staff->image);
                Storage::disk('public')->delete('staff/profileimage/'.$staff->image);
            }
            //Store New Image
            $image->storeAs('staff/profileimage/', $imageName, 'local');
            $image->storeAs('staff/profileimage/', $imageName, 'public');


        }
        else
        {
            $imageName = $staff->image;
        }

        $staff->update([
            'name'=>Request::input('name'),
            // 'email'=>Request::input('email'),
            // 'slug'=> Request::input('slug'),
            'title'=>Request::input('title'),
            'description'=>Request::input('description'),
            'image'=>$imageName,
            'job_title'=>Request::input('job_title'),
        ]);

        return redirect()->back()->with('success', 'Staff Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        //Check for authorization before delete
        $staff->delete();
        
        if($staff->image !== 'default-profileimage.jpg'){
            Storage::disk('local')->delete('staff/profileimage/'.$staff->image);
            Storage::disk('public')->delete('staff/profileimage/'.$staff->image);
        }

        foreach($staff->images as $image){

            Storage::disk('local')->delete('staff/images/'.$image->url);
            Storage::disk('public')->delete('staff/images/'.$image->url);
            $image->delete();

        }
        
        return redirect()->back()->with('success', 'Staff Deleted Successfully');

    }


    public function uploadImages(Request $request)
    {

        $staff = Staff::where('id', Request::input('id'))->first();
        $images = Request::file('images');
        
        //Handle File Upload
        if(Request::hasFile('images'))
        {
            foreach(Request::file('images') as $image){
                $imageName = $staff->slug.'-image-'.time().'-'.rand(1,100).'.'.$image->extension();
                
                /**Symlink is disabled on my public host provider so i have to duplicate these entries*/

                $image->storeAs('staff/images/', $imageName, 'local');
                $image->storeAs('staff/images/', $imageName, 'public');
                
                $staff->images()->create([
                    'url' => $imageName,
                ]);
                
            }
        } 

        return back()->with('success', 'Upload Successful!');
    }

    public function destroyImage($id)
    {

        $image = Image::find($id);

        Storage::disk('local')->delete('staff/images/'.$image->url);
        Storage::disk('public')->delete('staff/images/'.$image->url);

        $image->delete();
        
        return back()->with('success', 'Image Deleted Successful!');
    }


    public function destroyImages()
    {
        foreach(Request::input('ids') as $id){

            $image = Image::find($id);
    
            Storage::disk('local')->delete('staff/images/'.$image->url);
            Storage::disk('public')->delete('staff/images/'.$image->url);
    
            $image->delete();
        }
        
        return back()->with('success', 'Image Deleted Successful!');
    }



    public function updateImage($id)
    {

        $image_res = Image::find($id);
        // dd($image_res);

        $image = Request::file('image');

        //Handle File Upload
        if(Request::hasFile('image'))
        {       
                $imageName = 'new-'.$image_res->url;
                
                //Delete Original Image From Directory
                Storage::disk('local')->delete('staff/images/'.$image_res->url);
                Storage::disk('public')->delete('staff/images/'.$image_res->url);
                
                //Upload New Image
                /**Symlink is disabled on my public host provider so i have to duplicate these entries*/
                $image->storeAs('staff/images/', $imageName, 'local');
                $image->storeAs('staff/images/', $imageName, 'public');
        } 
        else{
            $imageName = $image_res->url;
        }

        $image_res->update([
            'title'=>Request::input('title'),
            'description'=>Request::input('description'),
            'url'=>$imageName,
        ]);
        
        return redirect()->back()->with('success', 'Image Updated Successful!');
    }

}
