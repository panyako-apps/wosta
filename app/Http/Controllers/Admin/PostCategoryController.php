<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PostCategoryResource;

class PostCategoryController extends Controller
{


    public function index(){
        // $postcategories = PostCategoryResource::collection(PostCategory::latest()->get());
        // return Inertia::render('Dashboard/PostCategory/Index', [
        //     'postcategories' => $postcategories,
        // ]);
        return;
    }


    public function store(Request $request)
    {

        
        $slug = Str::slug(Request::input('name')).time();
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'.'.$image->extension();
            $image->storeAs('postcategory/coverimage/', $imageName, 'local');
            $image->storeAs('postcategory/coverimage/', $imageName, 'public');
        }
        else
        {
            $imageName = 'default-coverimage.jpg';
        }

        Auth::user()->postCategories()->create([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'image'=>$imageName,
            'parent_id'=>Request::input('parent_id'),
        ]);

        return redirect()->back()->with('success', 'Post Category Created Successfully');
        
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

        // dd(Request::all());

        $postcategory = PostCategory::findOrFail($id);
        $slug = Str::slug(Request::input('name'));

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'-'.time().'.'.$image->extension();
            
            if($postcategory->image !== 'default-coverimage.jpg'){
                Storage::disk('local')->delete('postcategory/coverimage/'.$postcategory->image);
                Storage::disk('public')->delete('postcategory/coverimage/'.$postcategory->image);
            }
            
            $image->storeAs('postcategory/coverimage/', $imageName, 'local');
            $image->storeAs('postcategory/coverimage/', $imageName, 'public');

        }
        else
        {
            $imageName = $postcategory->image;
        }

        $postcategory->update([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'image'=>$imageName,
            'parent_id'=>Request::input('parent_id'),
        ]);

        return redirect()->back()->with('success', 'Post Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postcategory = PostCategory::find($id);
        //Check for authorization before delete
        $postcategory->delete();

        if($postcategory->image !== 'default-coverimage.jpg'){
            Storage::disk('local')->delete('postcategory/coverimage/'.$postcategory->image);
            Storage::disk('public')->delete('postcategory/coverimage/'.$postcategory->image);
        }

        return redirect()->back()->with('success', 'Post Category Deleted Successfully');

    }

}
