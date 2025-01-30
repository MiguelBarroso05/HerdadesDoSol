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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('status')->default(0);
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('estate_id')->constrained('estates');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->date('payment_date');
            $table->softDeletes();
        });

        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('name')->nullable();
            $table->string('nif')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('identifier')->nullable();
            $table->string('name');
            $table->string('number');
            $table->string('cvv');
            $table->string('validity');
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('billings');
        Schema::dropIfExists('payment_methods');
    }
};
