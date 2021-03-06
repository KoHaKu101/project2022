<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NKD_USER', function (Blueprint $table) {
            $table->BigInteger('UNID')->primary();
            $table->string('USERNAME', 150)->unique();
            $table->string('EMAIL', 150)->unique();
            $table->timestamp('EMAIL_VERIFIED_AT')->nullable();
            $table->string('password');
            $table->string('STATUS', 50);
            $table->string('ROLE', 50);
            $table->string('FIRST_NAME', 150);
            $table->string('LAST_NAME', 150);
            $table->rememberToken();
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
        Schema::dropIfExists('NKD_USER');
    }
}