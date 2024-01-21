<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('true')->nullable();
            $table->string('false')->nullable();
            $table->string('nilai')->nullable();
            $table->text('cheat')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}

