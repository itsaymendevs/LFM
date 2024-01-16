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
        Schema::create('file_case_opponents', function (Blueprint $table) {
            $table->id();

            // 1: file - case - opponent
            $table->bigInteger('fileId')->unsigned()->nullable();
            $table->foreign('fileId')->references('id')->on('files')->onDelete('cascade');

            $table->bigInteger('caseId')->unsigned()->nullable();
            $table->foreign('caseId')->references('id')->on('file_cases')->onDelete('cascade');

            $table->bigInteger('opponentId')->unsigned()->nullable();
            $table->foreign('opponentId')->references('id')->on('opponents')->onDelete('cascade');



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
        Schema::dropIfExists('file_case_opponents');
    }
};
