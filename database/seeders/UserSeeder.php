<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[
            [
              'name' => 'Wostac Admin',
              'email' => 'user@wostac.com',
              'email_verified_at' => now(),
              'password' => Hash::make('user@123'), 
              'remember_token' => Str::random(10),
            ],
            [
              'name' => 'Super Administrator',
              'email' => 'admin@wostac.com',
              'email_verified_at' => now(),
              'password' => Hash::make('admin@123'), 
              'remember_token' => Str::random(10),
            ],
        ];
  
        foreach($users as $user){
          $user = User::create($user);
          $user->userProfile()->update([
            'profileimage'=>'default-profileimage.jpg'
          ]);
        }
    }
}
