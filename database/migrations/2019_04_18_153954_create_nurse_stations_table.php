<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNurseStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_stations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('asuransi_id');
			$table->string('poli');
			$table->string('pasien_id');
			$table->string('staf_id');
			$table->string('tanggal');
			$table->string('jam');
			$table->string('hamil');
			$table->string('menyusui');
			$table->string('riwayat_alergi_obat');
			$table->string('tinggi_badan');
			$table->string('berat_badan');
			$table->string('suhu');
			$table->string('antrian');
			$table->string('perujuk_id');
			$table->string('asisten_id');
			$table->string('periksa_awal');
			$table->string('g');
			$table->string('p');
			$table->string('a');
			$table->string('hpht');
			$table->string('kecelakaan_kerja');
			$table->string('keterangan');
			$table->string('bukan_peserta');
			$table->string('sistolik');
			$table->string('diastolik');

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
        Schema::dropIfExists('nurse_stations');
    }
}
