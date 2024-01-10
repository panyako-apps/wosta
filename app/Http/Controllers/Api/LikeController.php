<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LikeController extends Controller
{

    public function index(){
        $model = Request::input('likeable_type')::find(Request::input('likeable_id'));
        return $model->likes;
    }

    public function store()
    {
        $model = Request::input('likeable_type')::find(Request::input('likeable_id'));
        
        if($model->likes->count()){

            $like = $model->likes->where('user_id', Request::input('user_id'))->first(); 
            
            if($like){
                $like->delete();
                return [
                    'status'=>200
                ];
            }
        }

        $model->likes()->create([
            'user_id'=>Request::input('user_id'),
        ]);

        return [
            'status'=>200
        ];

    }
}
