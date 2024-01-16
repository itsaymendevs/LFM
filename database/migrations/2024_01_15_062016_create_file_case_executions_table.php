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
        Schema::create('file_case_executions', function (Blueprint $table) {
            $table->id();


            // 1: general
            $table->string('executionNumber', 100)->nullable();
            $table->string('executionDate', 100)->nullable();

            $table->string('creationDate', 100)->nullable();

            $table->text('executionInformation')->nullable();
            $table->text('executionInformationAr')->nullable();

            $table->bigInteger('executionServiceId')->unsigned()->nullable();
            $table->foreign('executionServiceId')->references('id')->on('execution_services')->onDelete('cascade');



            // 1.2: Fees - amount
            $table->double('executionAmount', 8, 2)->nullable();
            $table->double('executionFees', 8, 2)->nullable();

            $table->double('collectedAmount', 8, 2)->nullable();
            $table->double('caseFees', 8, 2)->nullable();
            $table->double('officeFees', 8, 2)->nullable();



            // -----------------------------------------------------------------------------




            // 2: file / case / client
            $table->bigInteger('fileId')->unsigned()->nullable();
            $table->foreign('fileId')->references('id')->on('files')->onDelete('cascade');

            $table->bigInteger('caseId')->unsigned()->nullable();
            $table->foreign('caseId')->references('id')->on('file_cases')->onDelete('cascade');


            $table->bigInteger('clientId')->unsigned()->nullable();
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');






            // 3: creator - User
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
        Schema::dropIfExists('file_case_executions');
    }
};
