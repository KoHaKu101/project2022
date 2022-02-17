<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('POST', function (Blueprint$table) {
            $table->BigInteger('UNID')->primary();
            $table->string('POST_TYPE',150);
            $table->text('POST_TEXT');
            $table->string('POST_LINK')->nullable();
            $table->string('POST_NAME')->nullable();
            $table->string('POST_SCHOOL')->nullable();
            $table->integer('POST_DAY');
            $table->integer('POST_MONTH');
            $table->integer('POST_YEAR');
            $table->string('POST_STATUS',50);
            $table->string('POST_POSITION',50)->nullable();
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
