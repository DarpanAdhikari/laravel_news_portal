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
        Schema::create('nepali_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author')->nullable();
            $table->string('title')->unique();
            $table->unsignedBigInteger('en_post_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('feature_img')->nullable();
            $table->string('keywords');
            $table->string('tags')->nullable();
            $table->text('meta_description');
            $table->integer('category');
            $table->string('sub_category')->nullable();
            $table->text('content');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('author')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nepali_posts');
    }
};
