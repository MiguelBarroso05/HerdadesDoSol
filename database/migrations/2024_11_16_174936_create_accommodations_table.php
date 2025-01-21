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
        Schema::create('accommodation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accommodation_type_id')->constrained();
            $table->integer('size');
            $table->string('description')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_types');
        Schema::dropIfExists('accommodations');
    }
};
