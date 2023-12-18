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
        Schema::create('job', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                  ->constrained('company')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->string('jobName');
            $table->string('Category');
            $table->string('Salary');
            $table->text('jobDesc');
            $table->text('requirement');

            $table->string('status');

            $table->boolean('approved');
            $table->timestamps();
        });

        Schema::create('applied_job', function(Blueprint $table){
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('job_id')
                  ->constrained('job')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
        Schema::dropIfExists('applied_job');
    }
};
