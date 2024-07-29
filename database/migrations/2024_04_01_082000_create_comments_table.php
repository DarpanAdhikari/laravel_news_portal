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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id');
            $table->unsignedBigInteger('np_post_id')->nullable();
            $table->unsignedBigInteger('en_post_id')->nullable();
            $table->text('body');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('np_post_id')->references('id')->on('nepali_posts')->onDelete('cascade');
            $table->foreign('en_post_id')->references('id')->on('english_posts')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
