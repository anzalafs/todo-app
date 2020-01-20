<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_details', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('name', 100);
          $table->longText('description', 100);
          $table->dateTime('time');
          $table->enum('status', ['completed','snoozed','overdue','default'])->default('default');
          $table->integer('cat_id');
          // $table->dateTime('updated_at');
          // $table->dateTime('created_at');
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
        Schema::dropIfExists('todo_details');
    }
}
