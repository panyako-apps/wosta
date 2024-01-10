<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Inertia\Inertia;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = PageResource::collection(Page::all());
        return Inertia::render('Dashboard/Page/Index', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->pages()->create([
            'name'=>Request::input('name'),
        ]);

        return redirect()->back()->with('success', 'Page Created Successfully');
    }

    public function manage($id){
        $page = new PageResource(Page::find($id));
        if($page)
        {
            return Inertia::render('Dashboard/Page/Manage', compact('page'));
        }
        else {
            # code... 404 page with custom message
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update([
            'name'=>Request::input('name'),
        ]);

        return redirect()->route('admin.pages.index', $page->slug)->with('success', 'Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        //Check for authorization before delete
        $page->delete();

        return redirect()->back()->with('success', 'Page Deleted Successfully');

    }


    public function updateSection(Request $request)
    {
        $page = Page::findOrFail(Request::input('pageId'));
        $sectionName = Request::input('sectionName');

        $updatedSections = collect($page->sections)->map(function ($section) use ($sectionName, $request) {
            if ($section['name'] === $sectionName) {
                $section['title'] = Request::input('title');
                $section['intro'] = Request::input('intro');
                $section['description'] = Request::input('description');
                $section['points'] = Request::input('points');
            }
            return $section;
        })->all();


        $page->update(['sections' => $updatedSections]);

        return redirect()->back()->with('message', 'Section updated successfull');

    }



}