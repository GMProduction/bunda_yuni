<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransaksiuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            //
            $table->dropColumn('nama');
            $table->dropColumn('no_meja');
            $table->tinyInteger('status')->default(0);
            $table->dateTime('tanggal_pengiriman')->default(null)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            //
            $table->string('nama')->nullable(true)->default(null);
            $table->string('no_meja')->nullable(true)->default(null);
            $table->dropColumn('status');
            $table->dropColumn('tanggal_pengiriman');
        });
    }
}
