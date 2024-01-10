<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function index()
    {
        $roles = Role::all();
        
        $users = UserResource::collection(User::with(['userProfile', 'roles'])->paginate(50));
        return Inertia::render('Dashboard/User/Index', compact('users', 'roles') );

    }


    public function suspend(){
        // do something...
    }

    

}
