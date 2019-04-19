<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NurseStation;
use Input;
use App\Yoga;
use DB;

class NurseStationController extends Controller
{
	public function index(){
		$nurse_stations = NurseStation::all();
		return view('nurse_stations.index', compact(
			'nurse_stations'
		));
	}
	public function create(){
		return view('nurse_stations.create');
	}
	public function edit($id){
		$nurse_station = NurseStation::find($id);
		return view('nurse_stations.edit', compact('nurse_station'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$nurse_station       = new NurseStation;
		// Edit disini untuk simpan data
		$nurse_station->save();
		$pesan = Yoga::suksesFlash('NurseStation baru berhasil dibuat');
		return redirect('nurse_stations')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$nurse_station     = NurseStation::find($id);
		// Edit disini untuk simpan data
		$nurse_station->save();
		$pesan = Yoga::suksesFlash('NurseStation berhasil diupdate');
		return redirect('nurse_stations')->withPesan($pesan);
	}
	public function destroy($id){
		NurseStation::destroy($id);
		$pesan = Yoga::suksesFlash('NurseStation berhasil dihapus');
		return redirect('nurse_stations')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$nurse_stations     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$nurse_stations[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		NurseStation::insert($nurse_stations);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			/* 'data'           => 'required', */
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
