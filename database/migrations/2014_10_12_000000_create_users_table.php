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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // 1: general
            $table->string('name', 100)->nullable();
            $table->string('nameAr', 100)->nullable();

            $table->text('password');
            $table->string('phone', 100);
            $table->string('email', 255)->unique();


            // 1.2: isActive
            $table->boolean('isActive')->nullable()->default(1);



            // 1.3: role
            $table->bigInteger('roleId')->unsigned()->nullable();
            $table->foreign('roleId')->references('id')->on('roles')->onDelete('set null');





            // 2: token
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
