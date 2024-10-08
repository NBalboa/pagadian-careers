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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hiring_manager_id');
            $table->foreignId('score_id');
            $table->string('job_title');
            $table->text('description');
            $table->tinyInteger('job_setup'); // 0 = on-site, 1 = remote, 2 = hybrid
            $table->tinyInteger('job_type'); //0 = permanent, 1 = part_time, 2 full_time, 3= contractual
            $table->tinyInteger('show_salary')->default(1); //0-off //on-1
            $table->string('salary')->nullable();
            $table->tinyInteger('experience');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
