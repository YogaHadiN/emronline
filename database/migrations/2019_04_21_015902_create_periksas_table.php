<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksas', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->dateTime('waktu_datang');
			$table->string('asuransi_id');
			$table->string('pasien_id');
			$table->string('staf_id');
			$table->longText('anamnesa');
			$table->longText('pemeriksaan_fisik')->nullable();
			$table->longText('pemeriksaan_penunjang')->nullable();
			$table->string('diagnosa_id');
			$table->string('keterangan_diagnosa')->nullable();
			$table->longText('terapi')->nullable();
			$table->integer('piutang')->nullable();
			$table->integer('tunai')->nullable();
			$table->string('poli');
			$table->dateTime('waktu_periksa');
			$table->dateTime('waktu_masuk_apotek')->nullable();
			$table->longText('transaksi')->nullable();
			$table->integer('berat_badan')->nullable();
			$table->string('satisfaction_index')->nullable();
			$table->integer('piutang_dibayar')->nullable();
			$table->date('tanggal_piutang_dibayar_asuransi')->nullable();
			$table->string('asisten_id')->nullable();
			$table->dateTime('waktu_selesai_apotek')->nullable();
			$table->tinyInteger('kecelakaan_kerja');
			$table->longText('resepluar')->nullable();
			$table->integer('pembayaran')->nullable();
			$table->integer('kembalian')->nullable();
			$table->string('nomor_asuransi')->nullable();
			$table->string('nurse_station_id');
			$table->string('sistolik')->nullable();
			$table->string('diastolik')->nullable();
			$table->string('random_string');
			$table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periksas');
    }
}
