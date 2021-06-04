<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengusaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengusaha', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama', 50);
            $table->text('alamat');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('no_telp')->default(15);
            $table->string('email', 50);
            $table->text('gambar');
            $table->text('deskripsi');
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
        Schema::dropIfExists('pengusaha');
    }
}