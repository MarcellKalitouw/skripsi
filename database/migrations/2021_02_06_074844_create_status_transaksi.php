<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_transaksi');
            $table->uuid('id_user');
            $table->uuid('id_user');
            $table->string('updated_by', 50);
            $table->string('nama', 25);
            $table->enum('tipe', ['transaksi', 'shipping']);
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
        Schema::dropIfExists('status_transaksi');
    }
}