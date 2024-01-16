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
        Schema::create('file_case_attachments', function (Blueprint $table) {

            $table->id();


            // 1: general
            $table->string('documentName', 255)->nullable();
            $table->string('documentNameAr', 255)->nullable();

            $table->string('documentNumber', 100)->nullable();
            $table->string('documentDate', 100)->nullable();





            // 1.2: documentFile / Information
            $table->text('documentFile')->nullable();

            $table->text('documentInformation')->nullable();
            $table->text('documentInformationAr')->nullable();



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
        Schema::dropIfExists('file_case_attachments');
    }
};
