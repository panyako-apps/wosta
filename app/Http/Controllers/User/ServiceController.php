<?php

namespace App\Http\Controllers\User;

use Share;
use App\Models\View;
use Inertia\Inertia;
use App\Models\Staff;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\StaffResource;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\ServiceCategoryResource;

class ServiceController extends Controller
{
   
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


        $services = ServiceResource::collection(

            Service::query()
                ->when(Request::input('search'), 
                    function($query, $search)
                        {
                            $query->where('name', 'like', "%".$search."%")
                                ->where([
                                    'isPublished' => true
                                ]);
                        }
                    )
                ->when(Request::input('category_id'), 
                    function($query, $category_id)
                        {
                            $query->where('service_category_id', $category_id)
                                ->where([
                                    'isPublished' => true
                                ]);
                        },

                    function ($query){
                        $query->where([
                            'isPublished' => true,
                        ]);
                    }
                    )
                    ->paginate($perPage)
                );
        
        $categories = ServiceCategoryResource::collection(ServiceCategory::where('isPublished', true)->get());
        $staffMembers = StaffResource::collection(Staff::where('isPublished', true)->get());
        
        // return $categories;
     
        return Inertia::render('Service/Index', compact('services', 'categories', 'filters' , 'staffMembers'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->first()->load([
            'views',
            'likes',
            'images',
        ]);

        $sharelinks =  Share::page(request()->url(), $service->name)
            ->facebook()
            ->twitter()
            ->whatsapp()
            ->telegram()
            ->linkedin()
            ->getRawLinks();

    
        if($service){
            return Inertia::render('Service/Show', [
                'service' => new ServiceResource($service->load(['images','views', 'likes'])),
                'sharelinks' => $sharelinks,
            ]);
        }
        else{
            abort(404);
        }
    }


}

    

