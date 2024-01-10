<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=Role::all();
        
        User::all()->each(function($user) use ($roles){
            $user->roles()->attach(
                $roles->random(2)->pluck('id')
            );
        });
    }
}
