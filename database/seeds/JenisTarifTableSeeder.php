<?php

use Illuminate\Database\Seeder;

class JenisTarifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$jenis_tarifs = DB::connection('mysql2')->table('jenis_tarifs')->get();

		foreach ($jenis_tarifs as $jenis_tarif) {
			 DB::connection('mysql')->table('jenis_tarifs')->insert([
					'jenis_tarif' => $jenis_tarif->jenis_tarif,
					'coa_id'      => $jenis_tarif->coa_id
			 ]);
		}
    }
}
