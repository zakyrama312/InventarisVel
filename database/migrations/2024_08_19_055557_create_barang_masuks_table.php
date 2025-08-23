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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('slug')->nullable();
            $table->integer('stok_masuk')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('merk')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('bahan')->nullable();
            $table->integer('harga_beli')->nullable();
            $table->string('tahun_beli')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('id_kondisi')->constrained('kondisis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_jurusan')->constrained('jurusans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_ruang')->constrained('ruangs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
