<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\CoreValue;
use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SiteSettingController extends Controller
{
   
    public function index(){

        $sitesettings = SiteSetting::all();
        $corevalues = CoreValue::latest()->get();

        return Inertia::render('Dashboard/Setting/Index', [
            'sitesettings' => $sitesettings,
            'corevalues' => $corevalues,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $siteSetting = SiteSetting::find($id);

        $siteSetting->update([
            'title'=>Request::input('title'),
            'description'=>Request::input('description'),
            'updated_at'=>now(),
            'updated_by'=>Auth::user()->id,
        ]);

        return redirect()->route('admin.sitesettings.index')->with('success', 'Updated successfully');

    }

}
