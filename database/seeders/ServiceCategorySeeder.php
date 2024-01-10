<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $serviceCategories  = [
            [
                'user_id' => 1,
                'name'=>'Core Services',
                'description'=>'Our core services',
                'slug' => 'core-services',
                'image'=>'coreservices.jpg',
                'isPublished' => true,
            ],
            
        ];
  
        foreach($serviceCategories as $serviceCategory){
          ServiceCategory::create($serviceCategory);
        }
    }
}
