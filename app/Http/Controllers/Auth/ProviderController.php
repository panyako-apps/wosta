<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();

    }

    public function callback($provider){
        if($provider=='twitter'){
            $socialUser = Socialite::driver($provider)->user();
        }
        else{
            $socialUser = Socialite::driver($provider)->stateless()->user();
        }

        // dd($socialUser->token);
        

        $user = User::where([
            'provider' => $provider,
            'provider_id'=> $socialUser->id
        ])->first();

        if(!$user){
            
            if(User::where('email', $socialUser->attributes['email'])->exists()){
                return redirect('/login')->with('success', 'This email uses a different method to login.');
            }

            $user = User::create([
                'name'=>$socialUser->attributes['name'],
                'email'=>$socialUser->attributes['email'],
                'provider'=>$provider,
                'provider_id'=>$socialUser->id,
                'provider_token'=>$socialUser->token,
                'email_verified_at'=>now(),
            ]);

            if($user){
                $user->userProfile->update([
                    'avatar'=>$socialUser->attributes['avatar'],
                    // 'username'=>$socialUser->username,
                    // 'phone'=>$socialUser->phone?$socialUser->phone:null,
                ]);
            }
        }


        Auth::login($user);
     
        return redirect()->route('page.about');

   }
}
