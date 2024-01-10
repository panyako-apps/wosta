<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class FeatureModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Request::input('featurable_type')::find(Request::input('featurable_id'));
        return $model->isFeatured;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = Request::input('featurable_type')::find(Request::input('featurable_id'));
        
        $model->update([
            'isFeatured'=>!$model->isFeatured
        ]);

        return [
            'status'=>200, 
            'isFeatured' => $model->isFeatured
        ];
    }
}
