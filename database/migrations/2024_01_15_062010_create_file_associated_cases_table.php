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
        Schema::create('file_associated_cases', function (Blueprint $table) {
            $table->id();


            // 1: general
            $table->string('serial', 100)->nullable();

            $table->string('requestNumber', 100)->nullable();
            $table->string('requestDate', 100)->nullable();


            // ! :: has NO claimFees
            $table->string('creationDate', 100)->nullable();




            // 1.2: caseInfo
            $table->string('caseNumber', 100)->nullable();

            $table->text('caseInformation')->nullable();
            $table->text('caseInformationAr')->nullable();

            $table->bigInteger('caseTypeId')->unsigned()->nullable();
            $table->foreign('caseTypeId')->references('id')->on('case_types')->onDelete('set null');

            $table->bigInteger('caseStageId')->unsigned()->nullable();
            $table->foreign('caseStageId')->references('id')->on('case_stages')->onDelete('set null');










            // 1.3: clientTitle - court - department - expertOffice
            $table->bigInteger('clientTitleId')->unsigned()->nullable();
            $table->foreign('clientTitleId')->references('id')->on('client_titles')->onDelete('set null');

            $table->bigInteger('courtId')->unsigned()->nullable();
            $table->foreign('courtId')->references('id')->on('courts')->onDelete('set null');

            $table->bigInteger('departmentId')->unsigned()->nullable();
            $table->foreign('departmentId')->references('id')->on('departments')->onDelete('set null');


            $table->bigInteger('expertOfficeId')->unsigned()->nullable();
            $table->foreign('expertOfficeId')->references('id')->on('expert_offices')->onDelete('set null');






            // 1.4: courtFees
            $table->double('courtFees', 8, 2)->nullable();
            $table->double('discountAmount', 8, 2)->nullable();



            // 1.5: isOpen
            $table->boolean('isOpen')->nullable()->default(1);




            // -----------------------------------------------------------------------------




            // 3: file / case / branch / client
            $table->bigInteger('fileId')->unsigned()->nullable();
            $table->foreign('fileId')->references('id')->on('files')->onDelete('cascade');

            $table->bigInteger('caseId')->unsigned()->nullable();
            $table->foreign('caseId')->references('id')->on('file_cases')->onDelete('cascade');


            $table->bigInteger('clientId')->unsigned()->nullable();
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');


            $table->bigInteger('branchCityId')->unsigned()->nullable();
            $table->foreign('branchCityId')->references('id')->on('cities')->onDelete('cascade');










            // 4: administrative / advisor / pleading lawyer
            $table->bigInteger('administrativeId')->unsigned()->nullable();
            $table->foreign('administrativeId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('secAdministrativeId')->unsigned()->nullable();
            $table->foreign('secAdministrativeId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('thirdAdministrativeId')->unsigned()->nullable();
            $table->foreign('thirdAdministrativeId')->references('id')->on('users')->onDelete('set null');


            $table->bigInteger('advisorId')->unsigned()->nullable();
            $table->foreign('advisorId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('secAdvisorId')->unsigned()->nullable();
            $table->foreign('secAdvisorId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('thirdAdvisorId')->unsigned()->nullable();
            $table->foreign('thirdAdvisorId')->references('id')->on('users')->onDelete('set null');



            $table->bigInteger('pleadingLawyerId')->unsigned()->nullable();
            $table->foreign('pleadingLawyerId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('secPleadingLawyerId')->unsigned()->nullable();
            $table->foreign('secPleadingLawyerId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('thirdPleadingLawyerId')->unsigned()->nullable();
            $table->foreign('thirdPleadingLawyerId')->references('id')->on('users')->onDelete('set null');







            // 4:  creator -> user
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
        Schema::dropIfExists('file_associated_cases');
    }
};
