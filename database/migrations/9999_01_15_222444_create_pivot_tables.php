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
        Schema::create('reservation_activities', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained();
            $table->foreignId('activity_id')->constrained();
            $table->timestamps();

            $table->primary(['reservation_id', 'activity_id']);
        });
        //Users pivot tables
        Schema::create('users_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->string('addressPhone')->nullable();
            $table->string('addressIdentifier')->nullable();
            $table->boolean('isFavorite')->default(false);
            $table->unsignedBigInteger('order')->nullable()->default(0);

            $table->primary(['user_id', 'address_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        Schema::create('users_allergies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('allergy_id');
            $table->softDeletes();

            $table->primary(['user_id', 'allergy_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('allergy_id')->references('id')->on('allergies');
        });

        Schema::create('users_preferences', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('preference_id');
            $table->softDeletes();

            $table->primary(['user_id', 'preference_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('preference_id')->references('id')->on('preferences');
        });

        //Sales pivot tables
        Schema::create('activity_sales', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnDelete();
            $table->foreignId('sales_id')->constrained('sales')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['activity_id', 'sales_id']);
        });

        Schema::create('accommodation_sales', function (Blueprint $table) {
            $table->foreignId('accommodations_id')->constrained('accommodations')->cascadeOnDelete();
            $table->foreignId('sales_id')->constrained('sales')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['accommodations_id', 'sales_id']);
        });
        #Orders pivot
        Schema::create('orders_products', function (Blueprint $table) {
            $table->string('order_id')->constrained('orders');
            $table->unsignedBigInteger('product_id')->constrained('products');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['order_id', 'product_id']);
        });
        Schema::create('orders_accommodations', function (Blueprint $table) {
            $table->string('order_id')->constrained('orders');
            $table->unsignedBigInteger('accommodation_id')->constrained('accommodations');
            $table->date('date_in');
            $table->date('date_out');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['order_id', 'accommodation_id']);
        });
        Schema::create('orders_accommodations_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('orders_accommodations_id')->constrained('orders_accommodations');
            $table->unsignedBigInteger('activity_id')->constrained('activities');

            $table->primary(['orders_accommodations_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Users pivot tables
        Schema::dropIfExists('users_addresses');
        Schema::dropIfExists('users_allergies');
        Schema::dropIfExists('users_preferences');

        //estates pivot tables
        Schema::dropIfExists('estates_accommodations');
        Schema::dropIfExists('estates_activities');

        //Sales pivot tables
        Schema::dropIfExists('activity_sales');
        Schema::dropIfExists('accommodation_sales');

        //Orders pivot
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_accommodations');
        Schema::dropIfExists('order_activities');
    }
};
