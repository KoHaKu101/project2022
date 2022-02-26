<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CONTRACT', function (Blueprint $table) {
           $table->BigInteger('UNID')->primary();
            $table->string('CONTRACT_TYPE',50);
            $table->string('CONTRACT_DATA',200);
            $table->string('CONTRACT_STATUS',50);

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
        Schema::dropIfExists('CONTRACT');
    }
}