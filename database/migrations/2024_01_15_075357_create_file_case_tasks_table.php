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
        Schema::create('file_case_tasks', function (Blueprint $table) {
            $table->id();


            // 1: general
            $table->string('taskName', 255)->nullable();
            $table->string('taskNameAr', 255)->nullable();

            $table->string('taskNumber', 100)->nullable();
            $table->string('taskType', 100)->nullable()->default('CASE TASK');

            $table->string('taskStartDate', 100)->nullable();
            $table->string('taskExecutionDate', 100)->nullable();
            $table->string('taskDueDate', 100)->nullable();





            // 1.2: description / note
            $table->text('taskDesc')->nullable();
            $table->text('taskDescAr')->nullable();

            $table->text('taskNote')->nullable();
            $table->text('taskNoteAr')->nullable();


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





            // 4: creator - User / Follower
            $table->bigInteger('creatorId')->unsigned()->nullable();
            $table->foreign('creatorId')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('followerId')->unsigned()->nullable();
            $table->foreign('followerId')->references('id')->on('users')->onDelete('set null');



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
        Schema::dropIfExists('file_case_tasks');
    }
};
