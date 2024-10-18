<?php

use App\Enums\IsDeletedCompany;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('profile');
            $table->string('name');
            $table->string('url');
            $table->text('description');
            $table->foreignId('address_id');
            $table->tinyInteger('is_deleted')->default(IsDeletedCompany::NO->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
