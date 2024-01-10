<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Image;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Message;
use App\Models\CoreValue;
use App\Models\Quotation;
use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ImageResource;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\QuotationResource;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  Auth::user();
        $notifications = $user->notifications;

        return Inertia::render('Dashboard/Index', [
            'notifications'=>$notifications,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quotations()
    {
        $quotations = QuotationResource::collection(Quotation::paginate(50)->load(['product']));
        return Inertia::render('Dashboard/Quotations', compact('quotations'));
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages()
    {
        $messages = Message::paginate(50);
        return Inertia::render('Dashboard/Messages', compact('messages'));
    }

    
}
