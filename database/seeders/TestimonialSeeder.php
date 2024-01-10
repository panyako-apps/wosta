<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials = [
            [
                'user_id' => 1,
                'name' => 'Kwame O. Addo',
                'title' => 'Mr.',
                'job_title' => 'Student',
                'testimony' => "
                Thanks to this incredible company, my international education dreams are a reality. Their unwavering support, insightful counseling, and seamless assistance in visa and passport processes opened doors to endless opportunities.",
                'image' => 'amina.jpg',
                'isFeatured' => true,
                'isPublished' => true,
            ],
            [
                'user_id' => 1,
                'name' => 'Ama K. Mensah',
                'title' => 'Miss',
                'job_title' => 'College Student',
                'testimony' => "Choosing this company was the best decision I made for my academic future. I'm grateful for the doors this company has opened for me.",
                'image' => 'mensah.jpg',
                'isFeatured' => true,
                'isPublished' => true,
            ],
            [
                'user_id' => 1,
                'name' => 'Chijioke M. Okonkwo',
                'title' => 'Mr.',
                'job_title' => 'High School Graduate',
                'testimony' => "Embarking on my international academic journey was made possible with the incredible assistance of this company. I highly recommend placing your trust in this remarkable team!",
                'image' => 'okonkwo.jpg',
                'isFeatured' => true,
                'isPublished' => true,
            ],
        ];
        

        foreach($testimonials as $testimonial){
            Testimonial::create($testimonial);
        }
    }
}




