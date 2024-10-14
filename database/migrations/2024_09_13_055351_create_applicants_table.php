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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('address_id')->nullable();
            $table->string('profile');
            $table->tinyInteger('gender');
            $table->tinyInteger('verified')->default(0); //0 Not Verified, 1 Verified
            $table->string('verifier')->nullable();
            $table->string('about')->nullable();
            $table->tinyInteger('edu_attainment')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
