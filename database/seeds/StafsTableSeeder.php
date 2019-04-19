<?php

use Illuminate\Database\Seeder;
use App\Staf;

class StafsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$stafs = [
			[
				'nama' => 'Yoga Hadi Nugroho',
				'user_id' => '1',
				'role_id' => '2'
			],
			[
				'nama' => 'Puri Widyani Martiadewi',
				'user_id' => '1',
				'role_id' => '2'
			]		
		];
		Staf::insert($stafs);
    }
}
