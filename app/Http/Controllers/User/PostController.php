<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\PostCategory;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Share;

class PostController extends Controller
{
    // Constructor 
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show', 
            'categoryIndex',
            'userPosts',
        ]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $perPage = Request::input('perPage') ? : 16;
        
        $filters = Request::only([
            'search', 
            'perPage',
            'category_id',
        ]);


        $posts = PostResource::collection(

            Post::query()
                ->when(Request::input('search'), 
                    function($query, $search)
                        {
                            $query->where('name', 'like', "%".$search."%")->where(['isPublished' => true ]);
                        }
                    )
                ->when(Request::input('category_id'), 
                    function($query, $category_id)
                        {
                            $query->where('post_category_id', $category_id)->where(['isPublished' => true ]);
                        },
                    function ($query){
                            $query->where(['isPublished' => true]);
                        }
                    )->latest()->paginate($perPage)
                );
                                       
                $categories = PostCategory::where('isPublished', true)->get();

                return Inertia::render('Post/Index', compact('posts', 'categories', 'filters'));
                
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        try{
        
            $post = Post::where('slug', $slug)->firstOrFail();

        }
        catch(\Exception $exception){
            abort(404);
        }
        
        $relatedPosts= Post::where('post_category_id', '=', $post->post_category_id)
                        ->where('id', '!=', $post->id)
                        ->where('isPublished', true)
                        ->get();

        $categories = PostCategory::whereHas('posts', function($query){
                        $query->where('isPublished', true);
                        })->get();


        $sharelinks =  Share::page(request()->url(), $post->name)
            ->facebook()
            ->twitter()
            ->whatsapp()
            ->telegram()
            ->linkedin()
            ->getRawLinks();
                        
                        
        $postresource = PostResource::make($post->load([
            'user',
            'postCategory']));
        
        return Inertia::render('Post/Show', [
            'post'=> $postresource,
            'relatedPosts'=>$relatedPosts,
            'categories'=> $categories,
            'sharelinks' => $sharelinks,
        ]);
    }

    

    /**
     * 
     * Display all post created by a particular user
     */
    public function userPosts($id)
    {

        $categories = PostCategory::where('isPublished', true)->get();

        $user = User::where('id', $id)->first();

        $perPage = Request::input('perPage') ? : 20;

        $posts = PostResource::collection(Post::where([
                'isPublished'=>true,
                'user_id'=>$user->id
            ]
        )->latest()->paginate($perPage));

        return Inertia::render('Post/UserPosts', [
            'posts' => $posts,
            'user' => $user,
            'categories'=>$categories,
            'profile'=>$user->userProfile,
        ]);


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryIndex($id)
    {
        $categories = PostCategory::where('isPublished', true)->get();

        $category = PostCategory::where('id', $id)->first();

        $perPage = Request::input('perPage') ? : 20;
        $posts = PostResource::collection(Post::where([
                'isPublished'=>true,
                'post_category_id'=>$category->id
            ]
        )->latest()->paginate($perPage));
        return Inertia::render('Post/PostCategoryIndex', [
            'posts' => $posts,
            'categories'=>$categories,
            'category'=>$category
        ]);
    }


}
