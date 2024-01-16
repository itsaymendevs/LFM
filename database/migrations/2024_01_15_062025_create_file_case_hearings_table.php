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
        Schema::create('file_case_hearings', function (Blueprint $table) {
            $table->id();


            // 1: general
            $table->string('hearingDate', 100)->nullable();
            $table->string('upcomingHearingDate', 100)->nullable();

            $table->bigInteger('hearingTypeId')->unsigned()->nullable();
            $table->foreign('hearingTypeId')->references('id')->on('hearing_types')->onDelete('cascade');





            // 1.2: courtInfo
            $table->string('courtHall', 255)->nullable();
            $table->string('courtAttendance', 100)->nullable();

            $table->text('courtDecision')->nullable();
            $table->text('courtDecisionAr')->nullable();

            $table->bigInteger('courtId')->unsigned()->nullable();
            $table->foreign('courtId')->references('id')->on('courts')->onDelete('cascade');





            // 1.3: notes
            $table->text('hearingNote')->nullable();
            $table->text('hearingNoteAr')->nullable();





            // -----------------------------------------------------------------------------





            // 2: advisor / pleading lawyer
            $table->bigInteger('advisorId')->unsigned()->nullable();
            $table->foreign('advisorId')->references('id')->on('users')->onDelete('set null');


            $table->bigInteger('pleadingLawyerId')->unsigned()->nullable();
            $table->foreign('pleadingLawyerId')->references('id')->on('users')->onDelete('set null');






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
        Schema::dropIfExists('file_case_hearings');
    }
};
