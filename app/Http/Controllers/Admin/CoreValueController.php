<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoreValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CoreValueController extends Controller
{
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $corevalue = CoreValue::find($id);

        $corevalue->update([
            'title'=>Request::input('title'),
            'description'=>Request::input('description'),
            'updated_by'=>Auth::user()->id,
        ]);

        return redirect()->route('admin.sitesettings.index')->with('success', 'Updated successfully');
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corevalue = CoreValue::find($id);
        $corevalue->delete();

        return redirect()->route('admin.sitesettings.index')->with('success', 'Updated successfully');

    }


}
