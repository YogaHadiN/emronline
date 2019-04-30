<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terapi;
use App\NurseStation;
use Input;
use App\Yoga;
use DB;

class TerapiController extends Controller
{
	public function index(){
		$terapis = Terapi::all();
		return view('terapis.index', compact(
			'terapis'
		));
	}
	public function create($id){
		/* return \App\Obat::selectList(); */
		$nurse_station = NurseStation::find( $id );
		return view('terapis.create', compact(
			'nurse_station'
		));
	}
	public function edit($id){
		$terapi = Terapi::find($id);
		return view('terapis.edit', compact('terapi'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$terapi       = new Terapi;
		// Edit disini untuk simpan data
		$terapi->save();
		$pesan = Yoga::suksesFlash('Terapi baru berhasil dibuat');
		return redirect('terapis')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$terapi     = Terapi::find($id);
		// Edit disini untuk simpan data
		$terapi->save();
		$pesan = Yoga::suksesFlash('Terapi berhasil diupdate');
		return redirect('terapis')->withPesan($pesan);
	}
	public function destroy($id){
		Terapi::destroy($id);
		$pesan = Yoga::suksesFlash('Terapi berhasil dihapus');
		return redirect('terapis')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$terapis     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$terapis[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Terapi::insert($terapis);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'data'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
