<?php

use Illuminate\Database\Seeder;

class AturanMinumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$aturans = DB::connection('mysql2')->table('aturan_minums')->get();
		foreach ($aturans as $aturan) {
			 DB::connection('mysql')->table('aturan_minums')->insert([
					'aturan_minum'                => $aturan->aturan_minum,
			 ]);
		}
    }
}
