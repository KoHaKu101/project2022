<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DETAIL_ID', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->string('DETAIL_TYPE',200);
            $table->string('DETAIL_HEAD',200)->nullable();

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
        Schema::dropIfExists('DETAIL_ID');
    }
}
