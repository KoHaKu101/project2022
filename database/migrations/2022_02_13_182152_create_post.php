<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('POST', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->string('POST_TYPE',50);
            $table->string('POST_HEADER',150);
            $table->text('POST_BODY')->nullable();
            $table->string('POST_IMG_LOGO',150);
            $table->string('POST_IMG_EXT',150);


            $table->string('POST_PDF',150)->nullable();
            $table->string('POST_PDF_EXT',150)->nullable();
            $table->integer('POST_DAY');
            $table->integer('POST_MONTH');
            $table->integer('POST_YEAR');
            $table->string('POST_STATUS',50);
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
        Schema::dropIfExists('POST');
    }
}