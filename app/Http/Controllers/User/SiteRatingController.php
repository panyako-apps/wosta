<?php

namespace App\Http\Controllers\User;

use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;


class SiteRatingController extends Controller
{

    public function rateUs()
    {
        $rating = new Rate;
        $rating_exists = Rate::where('user_id', Auth::user()->id)->first();

        if($rating_exists){
            $rating_exists->update([
                'rating'=>Request::input('rating'),
            ]);
            return redirect()->back()->with('success', 'Thanks. Your rating on us has been updated to - '.Request::input('rating'). ' Stars');
        }
        else{
            $rating->create([
                'rateable_type'=>'\Site\Rate',
                'rateable_id'=>0,
                'user_id'=>Auth::user()->id,
                'rating'=>Request::input('rating'),
            ]);
            return redirect()->back()->with('success', 'Thanks for Rating Us ! We really Appreciate your feedback.');
        }

    }


}
