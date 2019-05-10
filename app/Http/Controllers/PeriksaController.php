<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periksa;
use App\NurseStation;
use App\TransaksiPeriksa;
use Input;
use App\Yoga;
use DB;
use Auth;

class PeriksaController extends Controller
{
	public function index(){
		$periksas = Periksa::all();
		return view('periksas.index', compact(
			'periksas'
		));
	}
	public function create($id){
		$nurse_station = NurseStation::find($id);
		if ( !is_null($nurse_station->random_string) ) {
			return redirect('home/periksas/' . $nurse_station->periksa_id . '/edit');
		}
		$tindakans = TransaksiPeriksa::where('nurse_station_id', $id)->get();
		return view('periksas.create', compact(
			'nurse_station',
			'tindakans'
		));
	}
	public function edit($id){

		$periksa = Periksa::find($id);
		return view('periksas.edit', compact('periksa'));
	}
	public function store(Request $request){
		/* return Input::all(); */ 
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$nurse_station_id =  Input::get('nurse_station_id');
		/* return $nurse_station_id; */
		$nurse_station = NurseStation::find( $nurse_station_id );
		/* return $nurse_station; */


		$transaksis = TransaksiPeriksa::where('nurse_station_id', $nurse_station_id )->get();

		$random_string = substr(str_shuffle(MD5(microtime())), 0, 20);


		$periksa                        = new Periksa;
		$periksa->waktu_datang          = $nurse_station->waktu;
		$periksa->asuransi_id           = $nurse_station->asuransi_id;
		$periksa->pasien_id             = $nurse_station->pasien_id;
		$periksa->staf_id               = $nurse_station->staf_id;
		$periksa->anamnesa              = Input::get('anamnesa');
		$periksa->pemeriksaan_fisik     = Input::get('pemeriksaan_fisik');
		$periksa->pemeriksaan_penunjang = Input::get('pemeriksaan_penunjang');
		$periksa->diagnosa_id           = Input::get('diagnosa_id');
		$periksa->keterangan_diagnosa   = Input::get('keterangan_diagnosa');
		$periksa->poli                  = $nurse_station->poli->poli;
		$periksa->waktu_periksa         = Input::get('waktu_periksa');
		$periksa->transaksi             = json_encode($transaksis);
		$periksa->berat_badan           = Input::get('berat_badan');
		$periksa->asisten_id            = $nurse_station->asisten_id;
		$periksa->kecelakaan_kerja      = $nurse_station->kecelakaan_kerja;
		$periksa->nomor_asuransi        = $nurse_station->pasien->nomor_asuransi;
		$periksa->nurse_station_id      = Input::get('nurse_station_id');
		$periksa->sistolik              = Input::get('sistolik');
		$periksa->diastolik             = Input::get('diastolik');
		$periksa->random_string         = $random_string;
		$periksa->user_id               = Auth::id();
		$periksa->save();

		$nurse_station->periksa_id    = $periksa->id;
		$nurse_station->random_string = $random_string;
		$nurse_station->save();

		$poli_id = $nurse_station->poli_id;
		$pesan = Yoga::suksesFlash('Periksa baru berhasil dibuat');
		return redirect('home/nurse_stations/' . $poli_id . '/periksa/terapi' )->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$periksa     = Periksa::find($id);
		// Edit disini untuk simpan data
		$periksa->save();
		$pesan = Yoga::suksesFlash('Periksa berhasil diupdate');
		return redirect('home/periksas')->withPesan($pesan);
	}
	public function transaksiPeriksa($id){
		$nurse_station = NurseStation::find( $id );
		$tarif = Tarif::where('user_id', Auth::id())->get()->get();
		return view('transaksi_periksas.create', compact(
			'tarif',
			'nurse_station'
		));
	}
	
	public function destroy($id){
		Periksa::destroy($id);
		$pesan = Yoga::suksesFlash('Periksa berhasil dihapus');
		return redirect('home/periksas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$periksas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$periksas[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Periksa::insert($periksas);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){

		/* $periksa->waktu_datang                     = $nurse_station->waktu; */
		/* $periksa->asuransi_id                      = $nurse_station->asuransi_id; */
		/* $periksa->pasien_id                        = $nurse_station->pasien_id; */
		/* $periksa->staf_id                          = $nurse_station->staf_id; */
		/* $periksa->anamnesa                         = Input::get('anamnesa'); */
		/* $periksa->pemeriksaan_fisik                = Input::get('pemeriksaan_fisik'); */
		/* $periksa->pemeriksaan_penunjang            = Input::get('pemeriksaan_penunjang'); */
		/* $periksa->diagnosa_id                      = Input::get('diagnosa_id'); */
		/* $periksa->keterangan_diagnosa              = Input::get('keterangan_diagnosa'); */
		/* $periksa->poli                             = $nurse_station->poli->poli; */
		/* $periksa->waktu_periksa                    = Input::get('waktu_periksa'); */
		/* $periksa->transaksi                        = json_encode($transaksis); */
		/* $periksa->berat_badan                      = Input::get('berat_badan'); */
		/* $periksa->asisten_id                       = $nurse_station->asisten_id; */
		/* $periksa->kecelakaan_kerja                 = $nurse_station->kecelakaan_kerja; */
		/* $periksa->nomor_asuransi                   = $nurse_station->pasien->nomor_asuransi; */
		/* $periksa->nurse_station_id                 = Input::get('nurse_station_id'); */
		/* $periksa->sistolik                         = Input::get('sistolik'); */
		/* $periksa->diastolik                        = Input::get('diastolik'); */
		/* $periksa->user_id                          = Auth::id(); */

		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'anamnesa'         => 'required',
			'waktu_periksa'    => 'required|date',
			'diagnosa_id'      => 'required',
			'nurse_station_id' => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
