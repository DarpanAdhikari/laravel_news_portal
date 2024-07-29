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
        Schema::create('english_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author')->nullable();
            $table->foreign('author')->references('id')->on('users')->onDelete('set null');
            $table->string('title')->unique();
            $table->unsignedBigInteger('np_post_id')->nullable();
            $table->foreign('np_post_id')->references('id')->on('nepali_posts')->onDelete('set null');
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
        });
        Schema::table('nepali_posts', function (Blueprint $table) {
            $table->foreign('en_post_id')->references('id')->on('english_posts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nepali_posts', function (Blueprint $table) {
            $table->dropForeign(['en_post_id']);
        });
        Schema::dropIfExists('english_posts');
    }
};
