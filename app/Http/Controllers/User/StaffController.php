<?php

namespace App\Http\Controllers\User;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return Inertia::render('Staff/Index', compact('staff'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        return Inertia::render('Staff/Show', compact('staff'));
    }

}
