<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->string('title');
            $table->string('job_title');
            $table->string('image')->nullable();
            $table->mediumText('testimony');
            $table->boolean('isFeatured')->default(false);
            $table->boolean('isPublished')->default(false);           
            $table->integer('published_by')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
