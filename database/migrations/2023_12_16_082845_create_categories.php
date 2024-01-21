<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('token');
            $table->enum('status', [1, 2])->nullable();
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable(); // tambahan kolom jam selesai
            $table->integer('durasi')->nullable(); // durasi ujian dalam menit
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
