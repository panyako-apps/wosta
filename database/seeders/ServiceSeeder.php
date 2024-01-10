<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\Service::factory(10)->create();

        $services = [
           
            [
                'user_id' => 1,
                'service_category_id' => 1,
                'name' => 'Pre-Departure Counselling',
                'slug' => 'pre-departure-counselling',
                'description' => '<p>We provide guidance and support to students planning to travel or move to a new country. The goal is to ensure that the students are well-informed and prepared for the transition, practically and emotionally. If you are anxious about settling in a new country. we’re here to assist you to navigate all that.&nbsp;</p><p>&nbsp;</p><p>You are finally off to a great new adventure, congratulations! We know it seems a little daunting but trust us, the best is yet to come. And we are here to support you all the way. To help you be prepared for life in a new country with new people, our session covers but is not limited to; From visiting to belonging, Insights into the local culture, Student life in your new country, Culture shock, Support and well-being in your new country, Banking and foreign exchange, Working while you study and advice on internships, Dealing with homesickness, Brush up on legalities among others We will help students feel more prepared and confident in their decision to travel or move to a new country. Join us for cultural growth opportunities while you’re abroad.</p>',
                'tags' => '',
                'image' => 'pre-departure-counselling.jpg',
                'isPublished' => true,
                'isFeatured' => true
            ],
            [
                'user_id' => 1,
                'service_category_id' => 1,
                'name' => 'Career pathway counselling',
                'slug' => 'career-pathway-counselling',
                'description' => '<p>Career pathway consulting involves working to help you identify your career goals, assess their strengths and weaknesses, and develop a plan to achieve those goals. As a career pathway consultant, our primary goal is to help you maximize your potential and find meaningful work that aligns with your interests, skills, and values. We listen and help individuals determine their possible career pathways based on personality traits and factors.&nbsp;</p><p>&nbsp;</p><p>We explore individual skills and strengths, consider education levels and give advice about continuing education and changing global career trends. We also determine interests and personality types suitable for an increasingly dynamic, highly competitive, and technology-driven modern career world. Overall, we seek a deep understanding of your goals, skills, and strengths, and are committed to providing ongoing support and resources to help you achieve your goals.</p>',
                'tags' => '',
                'image' => 'career-pathway-counselling.jpg',
                'isPublished' => true,
                'isFeatured' => true
            ],
            [
                'user_id' => 1,
                'service_category_id' => 1,
                'name' => 'Documents verification',
                'slug' => 'document-verification',
                'description' => "<p>We will guide and support you on how the correct format for documents such as reports, proposals, and resumes. The goal is to ensure that the documents are visually appealing, easy to read and meet the standards and requirements of the intended audience. Document formatting plays a critical role in a student's success at immigration.&nbsp;</p><p>&nbsp;</p><p>In the documentation, we mainly prepare our students according to the requirements of targeted high Commissions or embassies. Mainly for student visas, embassies look for the financial status of the student’s guardian and whether they can afford living &amp; tuition fees in the guest country. Bank statements or medical and police reports are vital documents that may be required. We discuss all other documents with you and are here to guide students in presenting the necessary documents in the required format</p>",
                'tags' => 'residential, transition, real estate',
                'image' => 'document-verification.jpg',
                'isPublished' => true,
                'isFeatured' => true
            ],
            [
                'user_id' => 1,
                'service_category_id' => 1,
                'name' => 'University Application',
                'slug' => 'university-application',
                'description' => '<p>We provide guidance and support to students applying to colleges and universities. It helps students identify appropriate universities and programs, create effective application materials, and navigate the admissions process. Our education consultants are qualified and knowledgeable in the complete university admissions process and can guarantee students admission to some of the best universities in the world.&nbsp;</p><p>&nbsp;</p><p>Wosta Consult provides personalized guidance and support to students to navigate the complex and often stressful process of applying to universities. By providing expert advice and support, we help students achieve their academic and career goals and find a university that is the right fit for them. We do the necessary follow-up and secure admissions in the shortest possible time</p>',
                'tags' => 'residential, commercial, glass cleaning',
                'image' => 'university-application.jpg',
                'isPublished' => true,
                'isFeatured' => true
            ],
            [
                'user_id' => 1,
                'service_category_id' => 1,
                'name' => 'Student Visa application',
                'slug' => "student-visa-application',
                'description' => '<p>The most integral part of your study-abroad dream plan is preparing for the visa application needed for your course of study. The exact process and requirements can vary depending on the country you're applying to and your individual circumstances&nbsp;</p><p>&nbsp;</p><p>This process requires being familiar and well-researched with the visa procedures and policies of the country you are applying to. Having a university’s offer does not often mean that you will be granted a visa for your study unless you are well-prepared and ready for the visa interview process. At Wosta Consult we assist in all the steps of your visa application process, to make sure that you get the visa needed for your study and fulfilling your dream. Of key in our visa assistance process is advising you on the student visa procedures and rules of the country you are applying to, preparing you for the visa interview and helping you book the appointment for a successful outcome.&nbsp;</p><p>&nbsp;</p><p>Overall, We ensure that you are well-prepared to follow all the instructions and requirements. If you have any questions or concerns, don't hesitate to reach out. Good luck with your application!</p>',
                'tags' => 'residential, fabric care, stain removal",
                'image' => 'student-visa-application.jpg',
                'isPublished' => true,
                'isFeatured' => true
            ],
            
    
        ];

        foreach($services as $service){
            Service::create($service);
        }
    }
}

    

