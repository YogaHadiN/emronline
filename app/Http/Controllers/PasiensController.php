<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Pasien;
use App\Asuransi;
use App\Yoga;
use Auth;
use DB;

class PasiensController extends Controller
{
	public function index(){

		$ps               = new Pasien;
		$as               = new Asuransi;
		$statusPernikahan = $ps->statusPernikahan();
		$panggilan        = $ps->panggilan();
		$asuransi         = Yoga::asuransiList();
		$jenis_peserta    = $as->jenisPeserta();
		$peserta          = [ null => '- Pilih -', '0' => 'Peserta Klinik', '1' => 'Bukan Peserta Klinik'];
		$poli             = Yoga::poliList();
		$staf             = Yoga::stafList();
		$pesertaAtauBukan = Yoga::stafList();
		return view('pasiens.index', compact(
			'statusPernikahan',
			'panggilan',
			'peserta',
			'jenis_peserta',
			'asuransi',
			'poli',
			'staf'
		));
	}

	public function create(){
		$url    = url('/home/pasiens/image');

		$random_string = substr(str_shuffle(MD5(microtime())), 0, 10);

		$asuransis     = Asuransi::where('user_id', Auth::id())->pluck('nama_asuransi', 'id');
		$asuransis[1]  = 'Tidak Ada Asuransi';
		return view('pasiens.create', compact(
			'url',
			'random_string',
			'asuransis'
		));
	}
	public function update($id){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'tanggal_lahir' => 'date|date_format:d-m-Y',
			'nama'          => 'required',
			'tanggal_lahir' => 'required',
			'sex'           => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$pasien                         = Pasien::find($id);
		$pasien->nama                    = Input::get('nama');
		$pasien->nama_peserta            = Input::get('nama_peserta');
		$pasien->asuransi_id             = Input::get('asuransi_id');
		$pasien->nomor_asuransi          = Input::get('nomor_asuransi');
		$pasien->jenis_peserta_id        = Input::get('jenis_peserta_id');
		$pasien->alamat                  = Input::get('alamat');
		$pasien->sex                     = Input::get('sex');
		$pasien->tanggal_lahir           = Yoga::datePrep(Input::get('tanggal_lahir'));
		$pasien->no_ktp                  = Input::get('no_ktp');
		$pasien->no_telp                 = Input::get('no_telp');
		$pasien->nama_ayah               = Input::get('nama_ayah');
		$pasien->nama_ibu                = Input::get('nama_ibu');
		$pasien->riwayat_alergi_obat     = Input::get('riwayat_alergi_obat');
		$pasien->riwayat_penyakit_dahulu = Input::get('riwayat_penyakit_dahulu');
		$pasien->image                   = Input::get('image');
		$pasien->ktp_image               = Input::get('ktp_image');
		$pasien->email                   = Input::get('email');
		$pasien->bpjs_image              = Input::get('bpjs_image');
		$pasien->nomor_asuransi_bpjs     = Input::get('nomor_asuransi_bpjs');
		$pasien->nomor_ktp               = Input::get('nomor_ktp');
		$pasien->jangan_disms            = Input::get('jangan_disms');
		$pasien->user_id                 = Auth::id();
		$pasien->save();

		$pesan = Yoga::suksesFlash('Pasien '. $pasien->id . '-' . $pasien->nama . ' <strong>BERHASIL</strong> dihapus');
		return redirect('home/pasiens')->withPesan($pesan);
	}
	
	public function edit($id){
		$pasien = Pasien::find( $id );
		$url    = url('/home/pasiens/image');

		if ($pasien->user_id != Auth::id()) {
			$pesan = Yoga::gagalFlash('Maaf anda tidak bisa mengakses pasien ini');
			return redirect('home')->withPesan($pesan);
		}

		$random_string = substr(str_shuffle(MD5(microtime())), 0, 10);

		$asuransis     = Asuransi::where('user_id', Auth::id())->pluck('nama_asuransi', 'id');
		$asuransis[1]  = 'Tidak Ada Asuransi';
		return view('pasiens.edit', compact(
			'pasien',
			'url',
			'random_string',
			'asuransis'
		));


	}
	
	public function selectPasien(){
		if(Input::ajax()){

			$ID_PASIEN     = Input::get('id');
		    $nama          = Input::get('nama');
    		$namaPasien    = $this->pecah(Input::get('nama'));
		    $alamats       = Input::get('alamat');
            $array         = str_split($alamats);
			$alamat        = $this->pecah($alamats);
		    $tanggalLahir  = Yoga::datePrep(Input::get('tanggal_lahir'));
		    $noTelp        = Input::get('no_telp');
		    $namaIbu       = $this->pecah(Input::get('nama_ibu'));
		    $namaAyah      = $this->pecah(Input::get('nama_ayah'));
		    $namaPeserta   = Input::get('nama_peserta');
		    $namaAsuransi  = Input::get('nama_asuransi');
		    $nomorAsuransi = Input::get('nomorAsuransi');


		    $displayed_rows = Input::get('displayed_rows');
		    $key            = Input::get('key');
			$data           = $this->queryData($ID_PASIEN, $namaPasien, $alamat, $tanggalLahir, $noTelp, $namaAsuransi, $nomorAsuransi, $namaPeserta, $namaIbu, $namaAyah, $displayed_rows, $key);


			$count          = $this->queryData($ID_PASIEN, $namaPasien, $alamat, $tanggalLahir, $noTelp, $namaAsuransi, $nomorAsuransi, $namaPeserta, $namaIbu, $namaAyah, $displayed_rows, $key, true)[0]->jumlah;
			$pages          = ceil( $count/ $displayed_rows );

			return [
				'data'  => $data,
				'pages' => $pages,
				'key'   => $key,
				'rows'  => $count
			];
		}
	}
	private function queryData($ID_PASIEN, $namaPasien, $alamat, $tanggalLahir, $noTelp, $namaAsuransi, $nomorAsuransi, $namaPeserta, $namaIbu, $namaAyah, $displayed_rows, $key, $count = false){
			$pass = $key * $displayed_rows;

			$query  = "SELECT ";
			if (!$count) {
				$query .= "p.asuransi_id, p.id as ID_PASIEN, ";
				$query .= "p.nama as namaPasien, ";
				$query .= "p.alamat, ";
				$query .= "p.tanggal_lahir as tanggalLahir, ";
				$query .= "p.no_telp as noTelp, ";
				$query .= "asu.nama_asuransi as namaAsuransi, ";
				$query .= "p.nomor_asuransi as nomorAsuransi, ";
				$query .= "p.nama_peserta as namaPeserta, ";
				$query .= "p.nama_ibu as namaIbu, ";
				$query .= "p.nama_ayah as namaAyah, ";
				$query .= "p.image as image ";
			} else {
				$query .= "count(p.id) as jumlah ";
			}
			$query .= "FROM pasiens as p left outer join asuransis as asu on p.asuransi_id = asu.id ";
			$query .= "WHERE ";
			$query .= "(p.id like '%{$ID_PASIEN}%' or p.id is null) ";
			$query .= "AND (p.nama like '%{$namaPasien}%' or p.nama is null) ";
			$query .= "AND (p.alamat like '%{$alamat}%' or p.alamat is null) ";
			$query .= "AND (p.tanggal_lahir like '%{$tanggalLahir}%' or p.tanggal_lahir is null) ";
			$query .= "AND (p.no_telp like '%{$noTelp}%' or p.no_telp is null) ";
			$query .= "AND (asu.nama_asuransi like '%{$namaAsuransi}%' or asu.nama_asuransi is null) ";
			$query .= "AND (p.nomor_asuransi like '%{$nomorAsuransi}%' or p.nomor_asuransi is null) ";
			$query .= "AND (p.nama_peserta like '%{$namaPeserta}%' or p.nama_peserta is null) ";
			$query .= "AND (p.nama_ibu like '%{$namaIbu}%' or p.nama_ibu is null) ";
			$query .= "AND (p.nama_ayah like '%{$namaAyah}%' or p.nama_ayah is null) ";
			$query .= "AND p.user_id = " . Auth::id() . " ";
			/* $query .= "GROUP BY p.id "; */
			$query .= "ORDER BY p.created_at DESC ";


			if (!$count) {
				$query .= "LIMIT {$pass}, {$displayed_rows} ";
			}

			return DB::select($query);
	}

	public function pecah($nama){
		$array      = str_split($nama);
		$namaPasien = '';
		if ( count($array) > 1 ) {
			foreach ($array as $arr) {
				$namaPasien .= $arr . '%';
			}
		}
		return $namaPasien;
	}
	private function returnNullIfEmpty($var){
		if ( empty($var) ) {
			return [
				'',
				'null'
			];
		} else {
			return [
				"'". $var . "'",
				"'". $var . "'"
			];
		}

	}
	private function returnZeroIfNull($var){
		if ( is_null($var) ) {
			return '0' ;
		} else {
			return '1';
		}
	}
	private function returnZeroIfNotSet($var){
		if ( !isset($var) ) {
			return '0' ;
		} else {
			return '1';
		}
	}
	public function photoCapture($id){
		$random_string = $id;
		return view('pasiens.image', compact(
			'random_string'
		));
	}
	public function destroy($id){
		$pasien      = Pasien::find( $id );
		$nama_pasien = $pasien->nama;
		if ($pasien->delete()) {
			$pesan = Yoga::suksesFlash('Pasien ' . $id . '-' . $nama_pasien . ' <strong>BERHASIL</strong> dihapus');
			return redirect('home/pasiens')->withPesan($pesan);
		} else {
			$pesan = Yoga::gagalFlash('Pasien ' . $id . '-' . $nama_pasien . ' <strong>GAGAL</strong> dihapus');
			return redirect('home/pasiens')->withPesan($pesan);
		}
	}
}
