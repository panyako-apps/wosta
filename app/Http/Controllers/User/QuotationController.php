<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Service;
use App\Models\Quotation;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;

class QuotationController extends Controller
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

        // dd(Request::all());
        $fileName = '';
        
        $file = Request::file('file');

        if(Request::hasFile('file'))
        {
            $fileName = Str::random(8).'.'.time().'.'.$file->extension();
            $file->storeAs('quotation/files/', $fileName, 'local');
            $file->storeAs('quotation/files/', $fileName, 'public');
        }


        $quotation = Quotation::create([
            'name'=>Request::input('name'),
            'email'=>Request::input('email'),
            'phone'=>Request::input('phone'),
            'company'=>Request::input('company'),
            'service_id'=>Request::input('service_id'),
            'message'=>Request::input('message'),
            'file'=>$fileName,
        ]);
        

        try {
            if($quotation){
                return redirect()->back()->with('quotesubmitted', 'Your request was sent successfully');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        $services = Service::all();
        return Inertia::render('RequestQuote', compact('services')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuotationRequest $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }
}
