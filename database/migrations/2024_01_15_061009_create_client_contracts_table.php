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
        Schema::create('client_contracts', function (Blueprint $table) {
            $table->id();


            // 1: general

            $table->string('name', 255)->nullable();
            $table->string('nameAr', 255)->nullable();

            $table->double('amount', 8, 2)->nullable()->default(0);
            $table->string('fromDate', 100)->nullable();
            $table->string('untilDate', 100)->nullable();


            // 1.2: documentFile - Subject
            $table->text('documentFile')->nullable();
            $table->text('information')->nullable();
            $table->text('informationAr')->nullable();



            // 2: Address - contactInfo
            $table->string('country', 100)->nullable();
            $table->string('countryAr', 100)->nullable();

            $table->string('state', 100)->nullable();
            $table->string('stateAr', 100)->nullable();

            $table->string('city', 100)->nullable();
            $table->string('cityAr', 100)->nullable();

            $table->string('phone', 100)->nullable();

            $table->string('address', 255)->nullable();
            $table->string('addressAr', 255)->nullable();

            $table->string('note', 255)->nullable();
            $table->string('noteAr', 255)->nullable();



            // 3: client / contractType
            $table->bigInteger('contractTypeId')->unsigned()->nullable();
            $table->foreign('contractTypeId')->references('id')->on('contract_types')->onDelete('cascade');


            $table->bigInteger('clientId')->unsigned()->nullable();
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');



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
        Schema::dropIfExists('client_contracts');
    }
};
