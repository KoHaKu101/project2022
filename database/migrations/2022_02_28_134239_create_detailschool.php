<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailschool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DETAIL_SCHOOL', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->BigInteger('UNID_REF');
            $table->string('DETAIL_HEAD',200)->nullable();
            $table->text('DETAIL_TEXT')->nullable();
            $table->string('DETAIL_IMG',200)->nullable();
            $table->string('DETAIL_IMG_EXT',50)->nullable();
            $table->string('DETAIL_IMG_POSITION',50)->nullable();
            $table->integer('DETAIL_DAY');
            $table->integer('DETAIL_MONTH');
            $table->integer('DETAIL_YEAR');

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
        Schema::dropIfExists('DETAIL_SCHOOL');
    }
}
