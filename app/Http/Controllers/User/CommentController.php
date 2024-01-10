<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $comment = Comment::find(Request::input('comment_id'));

        $reply =  $comment->replies()->create([
            'name'=> auth()->user()->name,
            'email'=> auth()->user()->email,
            'user_id' => auth()->user()->id,
            'comment' => Request::input('comment'),
            'parent_id' => Request::input('comment_id'),
        ]);

        if($reply)
        {
            return back()->with("success", "Reply Submitted Successfully");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
