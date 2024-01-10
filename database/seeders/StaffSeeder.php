<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffMembers = [
            [
                'user_id' => 1,
                'name' => 'Amina Nkosi',
                'title' => 'Ms.',
                'email' => 'amina.nkosi@email.com',
                'slug' => 'amina-nkosi',
                'description' => 'A dedicated professional with a passion for excellence in education and societal reform.',
                'image' => 'amina.jpg',
                'job_title' => 'Educational Coordinator',
                'isFeatured' => true,
                'isPublished' => true,
            ],
            [
                'user_id' => 1,
                'name' => 'Sekou Kamara',
                'title' => 'Mr.',
                'email' => 'sekou.kamara@email.com',
                'slug' => 'sekou-kamara',
                'description' => 'Committed to empowering individuals through innovative educational initiatives.',
                'image' => 'sekou.jpg',
                'job_title' => 'Innovation Specialist',
                'isFeatured' => true,
                'isPublished' => true,
            ],
            [
                'user_id' => 1,
                'name' => 'Zainab Abiodun',
                'title' => 'Ms.',
                'email' => 'zainab.abiodun@email.com',
                'slug' => 'zainab-abiodun',
                'description' => 'Passionate about societal reform and advocating for positive change in communities.',
                'image' => 'zainab.jpg',
                'job_title' => 'Social Reformist',
                'isFeatured' => true,
                'isPublished' => true,
            ],
            [
                'user_id' => 1,
                'name' => 'Kwame Osei',
                'title' => 'Mr.',
                'email' => 'kwame.osei@email.com',
                'slug' => 'kwame-osei',
                'description' => 'Experienced in guiding individuals through successful international education journeys.',
                'image' => 'kwame.jpg',
                'job_title' => 'Education Advisor',
                'isFeatured' => true,
                'isPublished' => true,
            ],
        ];
        

        foreach($staffMembers as $staff){
            Staff::create($staff);
        }
    }
}
