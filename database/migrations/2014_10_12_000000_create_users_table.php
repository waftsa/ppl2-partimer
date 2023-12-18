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
            $table->id();
            $table->string('google_id')->nullable();
            $table->string('name');
            $table->text('phoneNum')->nullable();
            $table->text('socialMedia')->nullable();
            $table->integer('age')->nullable();
            $table->text('education')->nullable();
            $table->text('address')->nullable();
            $table->string('email');
            $table->string('password',60);
            $table->string('image')->nullable();
            $table->string('cv_url')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
