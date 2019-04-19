<?php

use Illuminate\Database\Seeder;

class ObatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$query  = "SELECT ";
		$query .= "m.merek as merek, ";
		$query .= "r.id as kode_rak, ";
		$query .= "r.harga_beli as harga_beli, ";
		$query .= "r.harga_jual as harga_jual, ";
		$query .= "r.exp_date as exp_date, ";
		$query .= "r.fornas as fornas, ";
		$query .= "r.stok as stok, ";
		$query .= "r.stok_minimal as stok_minimal, ";
		$query .= "f.dijual_bebas as dijual_bebas, ";
		$query .= "f.id as f_id, ";
		$query .= "f.sediaan as sediaan, ";
		$query .= "f.aturan_minum_id as aturan_minum_id, ";
		$query .= "f.peringatan as peringatan, ";
		$query .= "f.tidak_dipuyer as tidak_dipuyer ";
		$query .= "from mereks as m ";
		$query .= "left join raks as r on r.id = m.rak_id ";
		$query .= "left join formulas as f on f.id = r.formula_id ";
		$query .= ";";


		$obats = DB::connection('mysql2')->select($query);


		foreach ($obats as $obat) {
			/* dd($obat->f_id); */
			$query_formula  = "SELECT ";
			$query_formula .= "g.id as generik_id, ";
			$query_formula .= "k.bobot as bobot, ";
			$query_formula .= "f.id as formula_id, ";
			$query_formula .= "g.generik as generik ";
			$query_formula .= "from komposisis as k ";
			$query_formula .= "left join generiks as g on g.id = k.generik_id ";
			$query_formula .= "right outer join formulas as f on f.id = k.formula_id ";
			$query_formula .= "where formula_id = {$obat->f_id} ";
			$query_formula .= "and k.id is not null ";
			$komposisis = DB::connection('mysql2')->select($query_formula);

			$array_komposisi = [];
			foreach ($komposisis as $komposisi) {
				$array_komposisi[] = [
					'generik_id' => $komposisi->generik_id,
					'generik'    => $komposisi->generik,
					'bobot'      => $komposisi->bobot,
				];
			}

			usort($array_komposisi, function($a, $b) {
				return $a['generik_id'] <=> $b['generik_id'];
			});

			 DB::connection('mysql')->table('obats')->insert([
					'merek'           => $obat->merek,
					'formula'         => json_encode($array_komposisi),
					'kode_rak'        => $obat->kode_rak,
					'harga_beli'      => $obat->harga_beli,
					'harga_jual'      => $obat->harga_jual,
					'exp_date'        => $obat->exp_date,
					'fornas'          => $obat->fornas,
					'stok_minimal'    => $obat->stok_minimal,
					'stok'            => $obat->stok,
					'dijual_bebas'    => $obat->dijual_bebas,
					'sediaan'         => $obat->sediaan,
					'aturan_minum_id' => $obat->aturan_minum_id,
					'peringatan'      => $obat->peringatan,
					'tidak_dipuyer'   => $obat->tidak_dipuyer,
			 ]);
		}
    }
}
