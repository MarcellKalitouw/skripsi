<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_transaksi');
            $table->integer('id_user');
            $table->integer('id_pengusaha');
            $table->string('nama_kurir', 50);
            $table->text('alamat_jemput');
            $table->string('geocoding_jemput')->default(150);
            $table->text('alamat_antar');
            $table->string('geocoding_antar')->default(150);
            $table->text('gambar');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping');
    }
}