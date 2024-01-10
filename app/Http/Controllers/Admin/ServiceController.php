<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Image;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceCategoryResource;

class ServiceController extends Controller
{

    public function index(){

        $services = ServiceResource::collection(
            Service::latest()
            ->paginate(50)
        );
        
        $serviceCategories = ServiceCategoryResource::collection(
            ServiceCategory::all()
        );



        return Inertia::render('Dashboard/Service/Index', [
            'services' => $services,
            'categories' => $serviceCategories,
        ]);
    }


    public function store(Request $request)
    {
 
        $slug = Str::slug(Request::input('name')).time();
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'.'.$image->extension();
            $image->storeAs('service/coverimage/', $imageName, 'local');
            $image->storeAs('service/coverimage/', $imageName, 'public');
        }
        else
        {
            $imageName = 'default-coverimage.jpg';
        }

        Auth::user()->services()->create([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'tags'=>Request::input('tags'),
            'image'=>$imageName,
            'service_category_id'=>Request::input('service_category_id'),
        ]);

        return redirect()->back()->with('success', 'Staff Created Successfully');
        
    }



    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function manage($slug)
    {
        $service = new ServiceResource(Service::where('slug', $slug)->first()
            ->load([
                'images'
            ])
        );
  
        $categories = ServiceCategory::all();

        return Inertia::render('Dashboard/Service/Manage', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $service = Service::findOrFail($id);
        $slug = Str::slug(Request::input('name'));

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'-'.time().'.'.$image->extension();
            
            if($service->image !== 'default-coverimage.jpg'){
                Storage::disk('local')->delete('service/coverimage/'.$service->image);
                Storage::disk('public')->delete('service/coverimage/'.$service->image);
            }
            
            $image->storeAs('service/coverimage/', $imageName, 'local');
            $image->storeAs('service/coverimage/', $imageName, 'public');


        }
        else
        {
            $imageName = $service->image;
        }

        $service->update([
            'name'=>Request::input('name'),
            'tags'=>Request::input('tags'),
            'description'=>Request::input('description'),
            'image'=>$imageName,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        //Check for authorization before delete
        $service->delete();
        
        if($service->image !== 'default-coverimage.jpg'){
            Storage::disk('local')->delete('service/coverimage/'.$service->image);
            Storage::disk('public')->delete('service/coverimage/'.$service->image);
        }

        foreach($service->images as $image){

            Storage::disk('local')->delete('service/images/'.$image->url);
            Storage::disk('public')->delete('service/images/'.$image->url);
            $image->delete();

        }
        
        return redirect()->back()->with('success', 'Service Deleted Successfully');

    }



    public function destroyMultiple()
    {
        
        foreach(Request::input('ids') as $id){

            $service = Service::find($id);

            //Check for authorization before delete
            $service->delete();
            
            if($service->image !== 'default-coverimage.jpg'){
                Storage::disk('local')->delete('service/coverimage/'.$service->image);
                Storage::disk('public')->delete('service/coverimage/'.$service->image);
            }

            foreach($service->images as $image){

                Storage::disk('local')->delete('service/images/'.$image->url);
                Storage::disk('public')->delete('service/images/'.$image->url);
                $image->delete();

            }
                
        }
        
        return redirect()->back()->with('success', 'services Deleted Successfully');
    }





    public function uploadImages(Request $request)
    {

        $service = Service::where('id', Request::input('id'))->first();
        $images = Request::file('images');
        
        //Handle File Upload
        if(Request::hasFile('images'))
        {
            foreach(Request::file('images') as $image){
                $imageName = $service->name.'-image-'.time().rand(1,100).'.'.$image->extension();

                /**Symlink is disabled on my public host provider so i have to duplicate these entries*/
                $image->storeAs('service/images/', $imageName, 'local');
                $image->storeAs('service/images/', $imageName, 'public');
                
                $service->images()->create([
                    'url' => $imageName,
                ]);
                
            }

        } 

        return back()->with('success', 'Upload Successful!');
    }




    public function destroyImage($id)
    {

        $image = Image::find($id);

        Storage::disk('local')->delete('service/images/'.$image->url);
        Storage::disk('public')->delete('service/images/'.$image->url);

        $image->delete();
        
        return back()->with('success', 'Image Deleted Successful!');
    }


    public function destroyImages()
    {
        
        foreach(Request::input('ids') as $id){

            $image = Image::find($id);
    
            Storage::disk('local')->delete('service/images/'.$image->url);
            Storage::disk('public')->delete('service/images/'.$image->url);
    
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
                Storage::disk('local')->delete('service/images/'.$image_res->url);
                Storage::disk('public')->delete('service/images/'.$image_res->url);
                
                //Upload New Image
                /**Symlink is disabled on my public host provider so i have to duplicate these entries*/
                $image->storeAs('service/images/', $imageName, 'local');
                $image->storeAs('service/images/', $imageName, 'public');
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


    public function publishMultiple(){


        foreach(Request::input('ids') as $id){

            $service = Service::find($id);

            $service->update([
                'isPublished'=>true,
                'published_by'=>Auth::user()->id,
                'published_at'=>now(),
            ]);
    
        }

        
        return redirect()->back()->with('success', 'Services Published Successfully');

    }


    public function unPublishMultiple(){


        foreach(Request::input('ids') as $id){

            $service = Service::find($id);

            $service->update([
                'isPublished'=>false,
                'published_by'=>Auth::user()->id,
                'published_at'=>now(),
            ]);
    
        }

        
        return redirect()->back()->with('success', 'Services Un-published Successfully');

    }
    
    
    
    public function featureMultiple(){


        foreach(Request::input('ids') as $id){

            $service = Service::find($id);

            if(!$service->isPublished){
                $service->update([
                    'isPublished'=>true,
                    'isFeatured'=>true,
                ]);
            }
            else {
                $service->update([
                    'isFeatured'=>true,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Services Featured Successfully');

    }


    public function unFeatureMultiple(){


        foreach(Request::input('ids') as $id){

            $service = Service::find($id);
            
            if($service->isPublished && $service->isFeatured){
                $service->update([
                    'isFeatured'=>false,
                ]);
            }
    
        }

        return redirect()->back()->with('success', 'Services Un-Featured Successfully');

    }


    public function assignCategory(){


        foreach(Request::input('ids') as $id){

            $service = Service::find($id);
            
            $service->update([
                'service_category_id'=>Request::input('category'),
            ]);
 
        }

        return redirect()->back()->with('success', 'Category Assigned Successfully');

    }
}
