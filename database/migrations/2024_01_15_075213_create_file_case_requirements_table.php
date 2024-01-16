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
        Schema::create('file_case_requirements', function (Blueprint $table) {
            $table->id();

            // 1: general
            $table->string('requirementName', 255)->nullable();
            $table->string('requirementNameAr', 255)->nullable();


            $table->string('requirementDate', 100)->nullable();
            $table->string('requirementStatus', 100)->nullable()->default('PENDING');




            // 1.2: requirementFile / Information
            $table->text('requirementFile')->nullable();

            $table->text('requirementInformation')->nullable();
            $table->text('requirementInformationAr')->nullable();




            // 1.2: executor - inCharge
            $table->bigInteger('executorId')->unsigned()->nullable();
            $table->foreign('executorId')->references('id')->on('users')->onDelete('set null');




            // -----------------------------------------------------------------------------




            // 3: file / case / associatedCase (maybe Null) / client
            $table->bigInteger('fileId')->unsigned()->nullable();
            $table->foreign('fileId')->references('id')->on('files')->onDelete('cascade');

            $table->bigInteger('caseId')->unsigned()->nullable();
            $table->foreign('caseId')->references('id')->on('file_cases')->onDelete('cascade');


            $table->bigInteger('associatedCaseId')->unsigned()->nullable();
            $table->foreign('associatedCaseId')->references('id')->on('file_associated_cases')->onDelete('cascade');


            $table->bigInteger('clientId')->unsigned()->nullable();
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');





            // 4: creator - User
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
        Schema::dropIfExists('file_case_requirements');
    }
};
