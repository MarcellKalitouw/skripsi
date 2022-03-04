<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_transaksi')->nullable();
            $table->uuid('id_user')->nullable();
            $table->uuid('id_pengusaha')->nullable();
            $table->uuid('id_produk')->nullable();
            $table->double('harga');
            $table->integer('qty');
            $table->integer('diskon')->nullable();
            $table->double('total');
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
        Schema::dropIfExists('detail_transaksi');
    }
}