<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ViewController extends Controller
{

    public function store()
    {

        $model = \Request::input('viewable_type')::where('id', Request::input('viewable_id'))
            ->first()
            ->load([
                'views',
                'likes',
                'images',
            ]);
                
        $userHasViewed = $model->views->where('user_id', auth()->id())->first();
        $ipIsUsed = $model->views->where('ip', request()->ip())->first();
        $sessionIsRegistered = $model->views->where('session_id', request()->getSession()->getId())->first();
        
        // dd($sessionIsRegistered);

        if((auth()->check())){
            if($userHasViewed)
            {
                if($ipIsUsed){
                    return;
                }
                else {
                    $model->views()->create([
                        'url' => request()->url(),
                        'session_id' => request()->getSession()->getId(),
                        'ip' => request()->ip(),
                        'agent' => request()->header('User-Agent'),
                    ]);
                }
            }
            else
            {
                $model->views()->create([
                    'url' => request()->url(),
                    'session_id' => request()->getSession()->getId(),
                    'user_id' => auth()->id(), 
                    'ip' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                ]);
            }
        }
        else
        {
            if($ipIsUsed){
                return;
            }
            else {
                $model->views()->create([
                    'url' => request()->url(),
                    'session_id' => request()->getSession()->getId(),
                    'ip' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                ]);
            }
        }

        return;

    }


    public function getViews(){
        $model = \Request::input('viewable_type')::where('id', Request::input('viewable_id'))->first()->load([
            'views'
        ]);

        return response()->json($model->views);
    }
}
