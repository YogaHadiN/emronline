<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AturanMinum;
use Input;
use App\Yoga;
use DB;

class AturanMinumsController extends Controller
{
	public function index(){
		$aturan_minums = AturanMinum::paginate(15);
		return view('aturan_minums.index', compact(
			'aturan_minums'
		));
	}
	public function create(){
		return view('aturan_minums.create');
	}
	public function edit($id){
		$aturan_minum = AturanMinum::find($id);
		return view('aturan_minums.edit', compact('aturan_minum'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$aturan_minum       = new AturanMinum;
		// Edit disini untuk simpan data
		$aturan_minum->save();
		$pesan = Yoga::suksesFlash('AturanMinum baru berhasil dibuat');
		return redirect('home/aturan_minums')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$aturan_minum     = AturanMinum::find($id);
		// Edit disini untuk simpan data
		$aturan_minum->save();
		$pesan = Yoga::suksesFlash('AturanMinum berhasil diupdate');
		return redirect('home/aturan_minums')->withPesan($pesan);
	}
	public function destroy($id){
		AturanMinum::destroy($id);
		$pesan = Yoga::suksesFlash('AturanMinum berhasil dihapus');
		return redirect('home/aturan_minums')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$aturan_minums     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$aturan_minums[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		AturanMinum::insert($aturan_minums);
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
