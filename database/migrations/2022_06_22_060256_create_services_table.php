<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_category_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->mediumText('description')->nullable();
            $table->string('image');
            $table->string('tags')->nullable();
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
