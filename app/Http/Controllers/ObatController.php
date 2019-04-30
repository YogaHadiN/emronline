<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use Input;
use App\Yoga;
use DB;

class ObatController extends Controller
{
	public function index(){
		$obats = Obat::where('id', '>', 3)->paginate(20);
		return view('obats.index', compact(
			'obats'
		));
	}
	public function create(){
		return view('obats.create');
	}
	public function edit($id){
		$obat = Obat::find($id);
		return view('obats.edit', compact('obat'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$obat       = new Obat;
		// Edit disini untuk simpan data
		$obat->save();
		$pesan = Yoga::suksesFlash('Obat baru berhasil dibuat');
		return redirect('home/obats')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$obat     = Obat::find($id);
		// Edit disini untuk simpan data
		$obat->save();
		$pesan = Yoga::suksesFlash('Obat berhasil diupdate');
		return redirect('home/obats')->withPesan($pesan);
	}
	public function destroy($id){
		Obat::destroy($id);
		$pesan = Yoga::suksesFlash('Obat berhasil dihapus');
		return redirect('home/obats')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$obats     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$obats[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Obat::insert($obats);
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
	public function jenisObatPuyer(){
		$obats = Obat::where('sediaan','capsul')->orWhere('sediaan','tablet')->pluck('merek', 'id')->all();
		$data = [];
		foreach ($obats as $k => $obat) {
			$data[] = [
				'value' => $k,
				'text' => $obat
			];
		}

		return $data;

	}
	public function jenisObatAdd(){
		$obats = Obat::where('sediaan','dry syrup')->pluck('merek', 'id')->all();
		$data = [];
		foreach ($obats as $k => $obat) {
			$data[] = [
				'value' => $k,
				'text' => $obat
			];
		}
		return $data;
	}
	public function jenisObatStandar(){
		$obats = Obat::pluck('merek', 'id')->all();
		$data = [];
		foreach ($obats as $k => $obat) {
			$data[] = [
				'value' => $k,
				'text' => $obat
			];
		}

		return $data;

	}
	
	
}
