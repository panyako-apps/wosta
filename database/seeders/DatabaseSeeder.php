<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,
            PageSeeder::class,
            SlideshowSeeder::class,
            SlideSeeder::class,
            SiteSettingSeeder::class,
            StaffSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
