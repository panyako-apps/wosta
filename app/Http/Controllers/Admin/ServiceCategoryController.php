<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceCategoryResource;

class ServiceCategoryController extends Controller
{


    public function index(){
        $categories = ServiceCategoryResource::collection(ServiceCategory::all());
        return Inertia::render('Dashboard/ServiceCategory/Index', [
            'categories' => $categories,
        ]);
    }


    public function store(Request $request)
    {
 
        $slug = Str::slug(Request::input('name')).time();
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'.'.$image->extension();
            $image->storeAs('servicecategory/icon/', $imageName, 'local');
            $image->storeAs('servicecategory/icon/', $imageName, 'public');
        }
        else
        {
            $imageName = 'default-icon.jpg';
        }

        $serviceCategory =  Auth::user()->serviceCategories()->create([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'image'=>$imageName,
            'parent_id'=>Request::input('service_category_id'),
        ]);

        return redirect()->back()->with('success', 'Service Category Created Successfully');
        
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
        $serviceCategory = ServiceCategory::findOrFail($id);
        $slug = Str::slug(Request::input('name'));

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'-'.time().'.'.$image->extension();
            
            if($serviceCategory->image !== 'default-icon.jpg'){
                Storage::disk('local')->delete('servicecategory/icon/'.$serviceCategory->image);
                Storage::disk('public')->delete('servicecategory/icon/'.$serviceCategory->image);
            }
            
            $image->storeAs('servicecategory/icon/', $imageName, 'local');
            $image->storeAs('servicecategory/icon/', $imageName, 'public');


        }
        else
        {
            $imageName = $serviceCategory->image;
        }

        $serviceCategory->update([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'image'=>$imageName,
            'parent_id'=>Request::input('parent_id'),
        ]);

        return redirect()->back()->with('success', 'Service Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceCategory = ServiceCategory::find($id);
        //Check for authorization before delete
        $serviceCategory->delete();
        
        if($serviceCategory->image !== 'default-icon.jpg'){
            Storage::disk('local')->delete('servicecategory/icon/'.$serviceCategory->image);
            Storage::disk('public')->delete('servicecategory/icon/'.$serviceCategory->image);
        }

        return redirect()->back()->with('success', 'Service Deleted Successfully');

    }


}
