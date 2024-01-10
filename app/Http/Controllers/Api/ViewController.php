<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;


class ViewController extends Controller
{

    public function index()
    {
        $model = \Request::input('viewable_type')::find(Request::input('viewable_id'))->first()->load([
            'views'
        ]);
        return $model->views->count();
    }

}
