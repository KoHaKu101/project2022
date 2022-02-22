<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDircetor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DIRCETOR', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->text('DIRCETOR_TEXT');
            $table->string('DIRCETOR_TEXT_NAME')->nullable();
            $table->string('DIRCETOR_SCHOOL')->nullable();
            $table->string('STATUS',50);
            $table->string('DIRCETOR_IMG');
            $table->string('DIRCETOR_IMG_EXT',50)->nullable();

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
        Schema::dropIfExists('DIRCETOR');
    }
}