<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            /*Campos comuns entre clientes e admins*/
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('nif')->unique()->nullable();
            $table->string('password');
            $table->date('birthdate');
            $table->string('nationality')->nullable();
            $table->integer('standard_group')->default(1);
            $table->integer('children')->default(0);
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('language')->default(1);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            /*Campos únicos de staff*/
            $table->string('img')->nullable();

            /*Campos únicos de cliente*/
            $table->double('balance')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            #Campos chaves estrangeiras

            $table->foreign('language')->references('id')->on('languages');

        });

        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
        });

        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
        Schema::dropIfExists('users');
        Schema::dropIfExists('allergies');
        Schema::dropIfExists('preferences');
    }
};
