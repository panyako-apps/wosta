<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postCategories =[
            [
              'name' => 'Latest News',
              'slug' => 'latest-news',
              'isPublished'=>true,
            ],
        ];
  
        foreach($postCategories as $postCategory){
          PostCategory::create($postCategory);
        }
    }
}
