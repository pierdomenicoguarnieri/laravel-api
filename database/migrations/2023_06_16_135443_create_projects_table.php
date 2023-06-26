<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description')->nullable();
      $table->string('slug')->unique();
      $table->date('start_date');
      $table->date('end_date')->nullable();
      $table->integer('commits')->unsigned()->nullable();
      $table->boolean('finished');
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
    Schema::dropIfExists('projects');
  }
};
