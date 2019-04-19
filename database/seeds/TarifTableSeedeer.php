<?php

use Illuminate\Database\Seeder;

class TarifTableSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$query  = "SELECT * ";
		$query .= "FROM tarifs ";
		$query .= "WHERE ";
		$query .= "asuransi_id = 0; ";
		$data = DB::select($query);
		$tarifs = DB::connection('mysql2')->select($query);

		foreach ($tarifs as $tarif) {
			if (is_null($tarif->bhp_items)) {
				$tarif->bhp_items = '[]';
			}
			 DB::connection('mysql')->table('tarifs')->insert([
					'jenis_tarif_id'   => $tarif->jenis_tarif_id,
					'biaya'            => $tarif->biaya,
					'asuransi_id'      => $tarif->asuransi_id,
					'jasa_dokter'      => $tarif->jasa_dokter,
					'tipe_tindakan_id' => $tarif->tipe_tindakan_id,
					'bhp_items'        => $tarif->bhp_items
			 ]);
		}
    }
}
