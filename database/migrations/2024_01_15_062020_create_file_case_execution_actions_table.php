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
        Schema::create('file_case_execution_actions', function (Blueprint $table) {
            $table->id();


            // 1: general
            $table->string('creationDate', 100)->nullable();
            $table->double('collectedAmount', 8, 2)->nullable();


            $table->text('actionDesc')->nullable();
            $table->text('actionDescAr')->nullable();

            $table->text('actionNote')->nullable();
            $table->text('actionNoteAr')->nullable();


            // 1.2: documentFile / executionType
            $table->text('documentFile')->nullable();


            $table->bigInteger('executionTypeId')->unsigned()->nullable();
            $table->foreign('executionTypeId')->references('id')->on('execution_types')->onDelete('cascade');






            // ---------------------------------------------------------------------------


            // 2: caseExecution
            $table->bigInteger('caseExecutionId')->unsigned()->nullable();
            $table->foreign('caseExecutionId')->references('id')->on('file_case_executions')->onDelete('cascade');





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
        Schema::dropIfExists('file_case_execution_actions');
    }
};
