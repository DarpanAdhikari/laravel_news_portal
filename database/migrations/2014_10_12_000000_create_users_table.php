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
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci'; //this is used for other language support
            $table->id();
            $table->string('u_id');
            $table->string('social')->nullable();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('location')->nullable();
            $table->integer('status')->default(1);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
