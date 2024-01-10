<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
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
        return Inertia::render('Client/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $slug = Str::slug(Request::input('name')).time();

        Client::create([
            'name'=>Request::input('name'),
            'slug'=> $slug,
            'phone'=>Request::input('phone'),
            'email'=>Request::input('email'),
            'company'=>Request::input('company'),
        ]);

        return redirect()->back()->with('success', 'You have successfully registered as a client');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
