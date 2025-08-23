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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('barang_masuks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_peminjam')->nullable();
            $table->string('kelas')->nullable();
            $table->integer('jumlah')->nullable();
            $table->text('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal_kembali')->nullable();
            $table->foreignId('id_jurusan')->constrained('jurusans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
