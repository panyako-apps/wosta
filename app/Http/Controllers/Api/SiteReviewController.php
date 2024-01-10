<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Request;

class SiteReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ? Request::input('perPage') : 50;
        $comments = CommentResource::collection(
            Comment::where([
                'commentable_type'=>'App\\Models\\Page',
                'commentable_id'=>2,
            ])->paginate($perPage));
        return $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function published()
    {
        $perPage = Request::input('perPage') ? Request::input('perPage') : 5;

        $comments = CommentResource::collection(
            Comment::where([
                'commentable_type'=>'App\\Models\\Page',
                'commentable_id'=>2,
                'isPublished'=> true
            ])->paginate($perPage)
        );

        return $comments;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function featuredUserReview()
    {
        $featuredReview = CommentResource::collection(
            Comment::where([
                'commentable_type'=>'App\\Models\\Page',
                'commentable_id'=>2,
                'isPublished' =>true,
                'isFeatured' =>true,
            ])
            ->latest()->take(1)->get());

        return $featuredReview;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
