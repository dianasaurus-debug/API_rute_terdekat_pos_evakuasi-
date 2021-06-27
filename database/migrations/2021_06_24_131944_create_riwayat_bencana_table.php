<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatBencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_bencana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bencana_id');
            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');
            $table->date('date');
            $table->bigInteger('latitude');
            $table->bigInteger('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_bencana');
    }
}
