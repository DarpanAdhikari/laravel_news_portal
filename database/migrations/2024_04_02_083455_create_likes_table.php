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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id');
            $table->unsignedBigInteger('np_post_id')->nullable();
            $table->unsignedBigInteger('en_post_id')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->timestamps();

            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('np_post_id')->references('id')->on('nepali_posts')->onDelete('cascade');
            $table->foreign('en_post_id')->references('id')->on('english_posts')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
