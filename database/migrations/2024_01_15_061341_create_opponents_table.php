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
        Schema::create('opponents', function (Blueprint $table) {
            $table->id();

            // 1: general
            $table->string('name', 255)->nullable();
            $table->string('nameAr', 255)->nullable();

            $table->string('phone', 100)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('image')->nullable();



            // 1.3: extra general
            $table->string('fax', 100)->nullable();
            $table->text('information')->nullable();
            $table->text('informationAr')->nullable();








            // 2: nationality - identity - accountNumber
            $table->string('identity', 255)->nullable();
            $table->string('accountNumber', 255)->nullable();

            $table->bigInteger('nationalityId')->unsigned()->nullable();
            $table->foreign('nationalityId')->references('id')->on('nationalities')->onDelete('cascade');






            // 2.1: branch City - addressInfo
            $table->string('address', 255)->nullable();
            $table->string('addressAr', 255)->nullable();

            $table->bigInteger('branchCityId')->unsigned()->nullable();
            $table->foreign('branchCityId')->references('id')->on('cities')->onDelete('cascade');





            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opponents');
    }
};
