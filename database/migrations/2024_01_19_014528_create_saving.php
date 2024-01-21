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
        Schema::create('saving', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Id Penabung
            $table->unsignedBigInteger('teacher_id'); // Id yang memasukan Tabungan
            $table->integer('saldo_user')->unsigned();
            $table->enum('jenis_transaksi',[1,2]); // 1 = Menabung, 2 = Menarik
            $table->integer('saldo_transaksi')->unsigned();
            $table->integer('saldo_final')->unsigned();
            //Saldo Final = Saldo Sekarang + Saldo Transaksi (Penabungan)
            //Saldo Final = Saldo Sekarang - Saldo Transaksi (Penarikan)
            //Saldo Sekarang = Saldo Final
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving');
    }
};
