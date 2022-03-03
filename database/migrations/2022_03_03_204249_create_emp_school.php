<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EMP_SCHOOL', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->string('EMP_PREFIX',50);
            $table->string('EMP_FIRST_NAME_TH',200);
            $table->string('EMP_MIDDLE_NAME_TH',200);
            $table->string('EMP_LAST_NAME_TH',200);

            $table->string('EMP_FIRST_NAME_EN',200);
            $table->string('EMP_MIDDLE_NAME_EN',200);
            $table->string('EMP_LAST_NAME_EN',200);

            $table->string('EMP_IMG',200);
            $table->string('EMP_IMG_EXT',200);

            $table->integer('EMP_AGE');
            $table->string('EMP_SEX',50);
            $table->string('EMP_NATION',100);
            $table->string('EMP_RANK',100);
            $table->BigInteger('EMP_RANK_REF');
            $table->string('EMP_STATUS',100)->default('OPEN');

            $table->integer('EMP_IN_DAY')->nullable();
            $table->integer('EMP_IN_MONTH')->nullable();
            $table->integer('EMP_IN_YEAR')->nullable();

            $table->integer('EMP_OUT_DAY')->nullable();
            $table->integer('EMP_OUT_MONTH')->nullable();
            $table->integer('EMP_OUT_YEAR')->nullable();

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
        Schema::dropIfExists('EMP_SCHOOL');
    }
}