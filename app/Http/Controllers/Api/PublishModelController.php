<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PublishModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Request::input('publishable_type')::find(Request::input('publishable_id'));
        return $model->isPublished;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = Request::input('publishable_type')::find(Request::input('publishable_id'));
        
        if($model->isPublished){
            $model->update([
                'isPublished'=>false,
                'isFeatured'=>false,
                'published_by'=>Request::input('user_id'),
                'published_at'=>now(),
            ]);
        }
        else{
            $model->update([
                'isPublished'=>true,
                'published_by'=>Request::input('user_id'),
                'published_at'=>now(),
            ]);
        }

        return [
            'status'=>200, 
            'isPublished' => $model->isPublished
        ];
    }

}
