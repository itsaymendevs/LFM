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
        Schema::create('client_attachments', function (Blueprint $table) {
            $table->id();

            // 1: general

            // :: WORKLICENSE - IDENTITY - IDENTITY 2 - IDENTITY 3
            $table->string('type', 100)->nullable();
            $table->string('fromDate', 100)->nullable();
            $table->string('untilDate', 100)->nullable();
            $table->text('image')->nullable();


            // 1.2: client
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
        Schema::dropIfExists('client_attachments');
    }
};
