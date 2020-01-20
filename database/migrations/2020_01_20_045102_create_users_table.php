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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('f_name', 50);
            $table->string('l_name', 50);
            $table->string('email', 100);
            $table->string('password', 200);
            $table->string('mobile', 15);
            $table->enum('gender', ['Male','Female']);
            $table->date('b_day');
            $table->string('api_token', 200);
            // $table->dateTime('updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
