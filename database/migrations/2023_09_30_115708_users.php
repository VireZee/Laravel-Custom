<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role', 10);
            $table->string('profile_photo_path', 4096)->nullable();
            $table->string('created', 40);
            $table->string('verified', 40)->nullable();
            $table->string('verify_token')->nullable();
            $table->string('remember_token')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};