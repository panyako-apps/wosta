<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Request;
use App\Notifications\NewSiteReviewPosted;

class CommentController extends Controller
{

    public function index(){

        // $model = \Request::input('commentable_type')::find(Request::input('commentable_id'));

        return CommentResource::collection(
            Comment::where([
                'commentable_type'=>Request::input('commentable_type'),
                'commentable_id'=>Request::input('commentable_id'),
            ])->get()
        );
        
    }

    public function store()
    {
        
        $model = \Request::input('commentable_type')::find(Request::input('commentable_id'));

        $model->comments()->create([
            'user_id' => Request::input('user_id'),
            'comment' => Request::input('comment'),
            'parent_id' => Request::input('parent_id'),
        ]);

        // $user = User::find(1);

        // $user->notify(new NewSiteReviewPosted($model));
        

        return [
            'status'=>200
        ];

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
        $comment = Comment::findOrFail($id);

        $comment->update([
            'comment' => Request::input('comment'),
        ]);

        return [
            'status'=>200
        ];

    }



        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        //Check for authorization before delete
        foreach($comment->comments as $reply){
            $reply->delete();
        }
        $comment->delete();

        return [
            'status'=>200
        ];

    }



}

