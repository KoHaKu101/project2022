<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aboutschool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ABOUT_SCHOOL', function (Blueprint$table) {
            $table->BigInteger('UNID')->primary();
            $table->integer('ABOUT_NUMBER');
            $table->string('ABOUT_NAME',250);
            $table->text('ABOUT_TEXT');
            $table->string('ABOUT_IMG')->nullable();
            $table->string('ABOUT_IMG_EXT',100)->nullable();
            $table->string('ABOUT_IMG_POSITION',100)->nullable();
            $table->string('ABOUT_STATUS',50);
            $table->string('CREATE_BY', 200)->nullable();
            $table->string('CREATE_TIME', 50)->nullable();
            $table->string('MODIFY_BY', 200)->nullable();
            $table->string('MODIFY_TIME', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ABOUT_SCHOOL');
    }
}