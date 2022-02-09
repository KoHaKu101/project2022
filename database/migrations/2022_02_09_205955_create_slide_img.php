<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SLIDE_IMG', function (Blueprint$table) {
            $table->BigInteger('UNID')->primary();
            $table->BigInteger('UNID_SETTING_NUMBER');
            $table->integer('IMG_NUMBER')->nullable();
            $table->string('IMG_FILE')->nullable();
            $table->string('STATUS',50);
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
        Schema::dropIfExists('SLIDE_IMG');
    }
}