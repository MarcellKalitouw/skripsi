<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama', 50);
            $table->integer('no_telp')->default(15);
            $table->string('email', 50);
            $table->text('gambar'); 
            $table->enum('status', ['Aktiv', 'Tidak Aktiv']);
            $table->string('password',50);
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
        Schema::dropIfExists('pelanggan');
    }
}