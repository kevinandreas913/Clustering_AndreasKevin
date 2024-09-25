<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->char('kode_barang', 9)->unique();
            $table->string('nama'); 
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->char('kode_toko', 9)->unique();
            $table->string('nama_toko'); 
            $table->string('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->timestamps();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(Str::uuid());
            $table->foreignId('product_id')->constrained('products'); 
            $table->foreignId('store_id')->constrained('stores');
            $table->unsignedInteger('banyak_terjual'); 
            $table->decimal('harga_unit', 10, 2);
            $table->integer('durasi_penjualan')->nullable();
            $table->date('bulan_periode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('stores');
        Schema::dropIfExists('products');
    }
};
