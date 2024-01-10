<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Models\Image;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Request;

class ImageController extends Controller
{

    public function index()
    {
        $perPage = Request::input('perPage') ? Request::input('perPage') : 20;

        request()->merge([ 'folder' => Request::input('folder') ]);

        return ImageResource::collection(
            Image::where([
                'imageable_type'=>Request::input('imageable_type'),
                'imageable_id'=>Request::input('imageable_id'),
                'isPublished'=> true
            ])->paginate($perPage)
        );


    }


}
