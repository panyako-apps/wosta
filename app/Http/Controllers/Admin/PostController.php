<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{


    public function index(){
        $postCategories = PostCategory::all();
        $posts = PostResource::collection(Post::latest()->paginate(50));
        return Inertia::render('Dashboard/Post/Index', [
            'posts' => $posts,
            'categories' => $postCategories,
        ]);
    }


    public function store(Request $request)
    {
 
        $slug = Str::slug(Request::input('name')).time();
        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'.'.$image->extension();
            $image->storeAs('post/coverimage/', $imageName, 'local');
            $image->storeAs('post/coverimage/', $imageName, 'public');
        }
        else
        {
            $imageName = 'default-coverimage.jpg';
        }

        Auth::user()->posts()->create([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'tags'=>Request::input('tags'),
            'image'=>$imageName,
            'post_category_id'=>Request::input('post_category_id'),
        ]);

        return redirect()->back()->with('success', 'Post Created Successfully');
        
    }



    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function manage($slug)
    {
        
        $post = new PostResource(Post::where('slug', $slug)->first()
            ->load([
                'images'
            ])
        );
  
        $categories = PostCategory::all();

        return Inertia::render('Dashboard/Post/Manage', compact('post', 'categories'));
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
        $post = Post::findOrFail($id);
        $slug = Str::slug(Request::input('name'));

        $image = Request::file('image');

        if(Request::hasFile('image'))
        {
            $imageName = $slug.'-'.time().'.'.$image->extension();
            
            if($post->image !== 'default-coverimage.jpg'){
                Storage::disk('local')->delete('post/coverimage/'.$post->image);
                Storage::disk('public')->delete('post/coverimage/'.$post->image);
            }
            
            $image->storeAs('post/coverimage/', $imageName, 'local');
            $image->storeAs('post/coverimage/', $imageName, 'public');


        }
        else
        {
            $imageName = $post->image;
        }

        $post->update([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'description'=>Request::input('description'),
            'tags'=>Request::input('tags'),
            'image'=>$imageName,
            'post_category_id'=>Request::input('post_category_id'),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        //Check for authorization before delete
        $post->delete();

        if($post->image !== 'default-coverimage.jpg'){
            Storage::disk('local')->delete('post/coverimage/'.$post->image);
            Storage::disk('public')->delete('post/coverimage/'.$post->image);
        }

        foreach($post->images as $image){

            Storage::disk('local')->delete('post/images/'.$image->url);
            Storage::disk('public')->delete('post/images/'.$image->url);
            $image->delete();

        }
        
        return redirect()->back()->with('success', 'Post Deleted Successfully');

    }


    public function uploadImages(Request $request)
    {

        $post = Post::where('id', Request::input('id'))->first();
        $images = Request::file('images');
        
        //Handle File Upload
        if(Request::hasFile('images'))
        {
            foreach(Request::file('images') as $image){
                $imageName = $post->name.'-image-'.time().rand(1,100).'.'.$image->extension();

                /**Symlink is disabled on my public host provider so i have to duplicate these entries*/
                $image->storeAs('post/images/', $imageName, 'local');
                $image->storeAs('post/images/', $imageName, 'public');
                
                $post->images()->create([
                    'url' => $imageName,
                ]);
                
            }

        } 

        return back()->with('success', 'Upload Successful!');
    }




    public function destroyImage($id)
    {

        $image = Image::find($id);

        Storage::disk('local')->delete('post/images/'.$image->url);
        Storage::disk('public')->delete('post/images/'.$image->url);

        $image->delete();
        
        return back()->with('success', 'Image Deleted Successful!');
    }


    public function destroyImages()
    {

        foreach(Request::input('ids') as $id){

            $image = Image::find($id);
    
            Storage::disk('local')->delete('post/images/'.$image->url);
            Storage::disk('public')->delete('post/images/'.$image->url);
    
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
                Storage::disk('local')->delete('post/images/'.$image_res->url);
                Storage::disk('public')->delete('post/images/'.$image_res->url);
                
                //Upload New Image
                /**Symlink is disabled on my public host provider so i have to duplicate these entries*/
                $image->storeAs('post/images/', $imageName, 'local');
                $image->storeAs('post/images/', $imageName, 'public');
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
