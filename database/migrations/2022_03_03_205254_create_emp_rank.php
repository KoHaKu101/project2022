<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpRank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_rank', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->string('RANK_NAME_TH',200);
            $table->string('RANK_NAME_ENG',200)->nullable();
            $table->string('RANK_STATUS',50);

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
        Schema::dropIfExists('emp_rank');
    }
}