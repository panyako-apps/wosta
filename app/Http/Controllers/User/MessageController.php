<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contactmessage = Message::create([
            'name'=>Request::input('name'),
            'email'=>Request::input('email'),
            'subject'=>Request::input('subject'),
            'message'=>Request::input('message'),
        ]);

        
        try {
            if($contactmessage){
                return redirect()->back()->with('messagesent', 'Your message was sent successfully');
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
