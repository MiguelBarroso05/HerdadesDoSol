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
        Schema::create('activity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_type_id')->constrained();
            $table->foreignId('estate_id')->constrained('estates');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('img')->nullable();
            $table->date('date');
            $table->decimal('price', 8, 2);
            $table->integer('max_participants');
            $table->integer('participants');
            $table->boolean('adult_activity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_types');
        Schema::dropIfExists('activities');
    }
};
