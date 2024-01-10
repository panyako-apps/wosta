<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class VisitController extends Controller
{

    public function index(){
        $model = Request::input('visitable_type')::find(Request::input('visitable_id'));
        return $model->visits;
    }

    public function store()
    {

        
        $model = \Request::input('visitable_type')::find(Request::input('visitable_id'));
        
        if($model->visits->count()){

            $visit = $model->visits->where('user_id', Request::input('user_id'))->first(); 
            
            if($visit){
                $visit->delete();
                return [
                    'status'=>200
                ];
            }
        }

        $model->visits()->create([
            'user_id'=>Request::input('user_id'),
        ]);

        return [
            'status'=>200
        ];

    }
}
