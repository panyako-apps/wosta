<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    /**
     * Fetch a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ? Request::input('perPage') : 20;
        $posts = PostResource::collection(Post::where('isPublished', true)->paginate($perPage));
        return $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function published()
    {
        $posts = PostResource::collection(
            Post::where('isPublished',true)
                ->latest()
                ->paginate(20)
            );
        return $posts;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function featured()
    {
        // $products = ProductResource::collection(
        //     Product::where([
        //             'isPublished'=>true,
        //             'isFeatured'=>true
        //             ])
        //         ->latest()
        //         ->paginate(20)
        //         ->load([
        //             'likes',
        //             'views'
        //     ])
        // );

        // return $products;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function related($post_id, $category_id)
    {
        $posts = PostResource::collection(
            Post::where('isPublished',true)
                ->where('post_category_id',$category_id)
                ->where('id', '!=', $post_id)
                ->latest()
                ->get());
        return $posts;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtered($id)
    {
        $posts = PostResource::collection(
            Post::where([
                    'isPublished'=>true,
                    'post_category_id'=>$id
                ])
                ->latest()
                ->get());

        return $posts;

    }


}
