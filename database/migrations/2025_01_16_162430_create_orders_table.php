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
            $table->foreignId('address_id')->constrained('addresses');
            $table->integer('status')->default(0);
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('invoice_id')->constrained('invoices');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id')->constrained();
            $table->unsignedBigInteger('estate_id')->constrained();
            $table->unsignedBigInteger('accommodation_id')->constrained();
            $table->date('entry_date');
            $table->date('exit_date');
            $table->integer('groupsize');
            $table->integer('children');
            $table->decimal('price', 8, 2);
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('invoice_id')->constrained('invoices');
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_id')->constrained('billings');
            $table->unsignedBigInteger('payment_method_id')->constrained('payment_methods');
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
            $table->string('identifier')->default('Card')->nullable();
            $table->unsignedBigInteger('payment_method_type_id')->constrained('payment_method_types');
            $table->string('name');
            $table->string('number');
            $table->string('last4');
            $table->string('validity');
            $table->boolean('predefined')->default(false);

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('payment_method_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('billings');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('payment_method_types');
    }
};
