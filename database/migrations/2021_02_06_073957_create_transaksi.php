<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tgl');
            $table->uuid('id_status');
            $table->uuid('id_pelanggan');
            $table->uuid('id_pengusaha');
            $table->uuid('id_shipping');
            $table->integer('total_qty')->default(5);
            $table->integer('subtotal_qty')->default(5);
            $table->integer('pajak')->default(5);
            $table->integer('diskon')->default(5);
            $table->integer('biaya_tambahan')->default(10);
            $table->integer('biaya_pengiriman')->default(10);
            $table->integer('total')->default(12);
            $table->text('keterangan');
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
        Schema::dropIfExists('transaksi');
    }
}