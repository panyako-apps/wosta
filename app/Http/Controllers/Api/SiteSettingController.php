<?php

namespace App\Http\Controllers\Api;

use Inertia\Inertia;
use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SiteSettingController extends Controller
{
   
    public function index(){

        $siteSettings = SiteSetting::all();
        return $siteSettings;
    }

}
