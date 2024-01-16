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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            // 1: general
            $table->string('companyName', 255)->nullable();
            $table->string('companyNameAr', 255)->nullable();

            $table->string('phone', 100)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('logo')->nullable();




            // 2: address / info / establishment
            $table->text('address')->nullable();
            $table->text('addressAr')->nullable();

            $table->text('information')->nullable();
            $table->text('informationAr')->nullable();

            $table->text('establishment')->nullable();
            $table->text('establishmentAr')->nullable();


            // 3: websiteURL - API
            $table->text('WebsiteURL')->nullable();




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
        Schema::dropIfExists('abouts');
    }
};
