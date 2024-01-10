<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServiceResource::collection(
            Service::latest()
                ->paginate(20)->load([
                    'likes',
                    'views'
            ])
        );
        return $services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function published()
    {
        $services = ServiceResource::collection(
            Service::where('isPublished',true)
                ->latest()
                ->paginate(20)
                ->load([
                    'likes',
                    'views'
            ])
        );
        return $services;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function featured()
    {
        $services = ServiceResource::collection(
            Service::where([
                    'isPublished'=>true,
                    'isFeatured'=>true
                    ])
                ->latest()
                ->paginate(20)
                ->load([
                    'likes',
                    'views'
            ])
        );

        return $services;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtered($id)
    {
        $services = ServiceResource::collection(
            Service::where([
                    'isPublished'=>true,
                    'service_category_id'=>$id
                ])
                ->latest()
                ->get());

        return $services;

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
