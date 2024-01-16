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
        Schema::create('files', function (Blueprint $table) {
            $table->id();

            // 1: general
            $table->string('serial', 100)->nullable();
            $table->double('officeFees', 8, 2)->nullable()->default(0);

            $table->text('information')->nullable();
            $table->text('informationAr')->nullable();

            $table->string('creationDate', 100)->nullable();


            // 1.2: branch / client
            $table->bigInteger('clientId')->unsigned()->nullable();
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');

            $table->bigInteger('branchCityId')->unsigned()->nullable();
            $table->foreign('branchCityId')->references('id')->on('cities')->onDelete('cascade');




            // 1.3: creator -> user
            $table->bigInteger('creatorId')->unsigned()->nullable();
            $table->foreign('creatorId')->references('id')->on('users')->onDelete('set null');



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
        Schema::dropIfExists('files');
    }
};
