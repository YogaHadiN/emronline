<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				@if( isset($periksa) )
					@include('periksas.imagePasien', ['pasien_id' => $periksa->pasien_id])
				@else
					@include('periksas.imagePasien', ['pasien_id' => $nurse_station->pasien_id])
				@endif
			</div>
		</div>
	</div>
</div>

@if( isset($periksa) )
	<h1>{{ $periksa->pasien->nama }}</h1>
@else
	<h1>{{ $nurse_station->pasien->nama }}</h1>
@endif
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<tbody>
					<tr>
						<td>
							<strong>Pembayaran</strong>	
						</td>
						<td>
							@if(isset($periksa))
								{{ $periksa->asuransi->nama_asuransi }}	
							@else
								{{ $nurse_station->asuransi->nama_asuransi }}	
							@endif
						</td>
					</tr>
					<tr>
						<td>
						<strong>Pemeriksa</strong>
						</td>
						<td>
							@if(isset($periksa))
								{{ $periksa->staf->nama }}	
							@else
								{{ $nurse_station->staf->nama }}	
							@endif
						</td>
					</tr>
					<tr>
						<td>
						<strong>Nurse Station</strong>	
						</td>
						<td>
							@if(isset($periksa))
								 {{ $periksa->asisten->nama }}	
							@else
								{{ $nurse_station->asisten->nama}}	
							@endif
						</td>
					</tr>
					@if( isset($periksa) && $periksa->kecelakaan_kerja )
						@include('periksas.kecelakaan_kerja')
					@elseif( !isset($periksa) && $nurse_station->kecelakaan_kerja )
						@include('periksas.kecelakaan_kerja')
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row hide">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nurse_station_id'))has-error @endif">

			@if( isset($periksa) )
				{!! Form::text('nurse_station_id', $periksa->nurse_station_id, array(
					'class'         => 'form-control rq'
				))!!}
			@else
				{!! Form::text('nurse_station_id', $nurse_station->id, array(
					'class'         => 'form-control rq'
				))!!}
			@endif
		  @if($errors->has('nurse_station_id'))<code>{{ $errors->first('nurse_station_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row hide">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('waktu_periksa'))has-error @endif">
		  {!! Form::label('waktu_periksa', 'Waktu Periksa', ['class' => 'control-label']) !!}
			{!! Form::textarea('waktu_periksa', date('Y-m-d H:i:s'), array(
				'class'         => 'form-control textareacustom'
			))!!}
		  @if($errors->has('waktu_periksa'))<code>{{ $errors->first('waktu_periksa') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('anamnesa'))has-error @endif">
		  {!! Form::label('anamnesa', 'Anamnesis', ['class' => 'control-label']) !!}
			{!! Form::textarea('anamnesa', null, array(
				'class'         => 'form-control textareacustom rq'
			))!!}
		  @if($errors->has('anamnesa'))<code>{{ $errors->first('anamnesa') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('pemeriksaan_fisik'))has-error @endif">
		  {!! Form::label('pemeriksaan_fisik', 'Pemeriksaan Fisik', ['class' => 'control-label']) !!}
			{!! Form::textarea('pemeriksaan_fisik', null, array(
				'class'         => 'form-control textareacustom'
			))!!}
		  @if($errors->has('pemeriksaan_fisik'))<code>{{ $errors->first('pemeriksaan_fisik') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">

	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group @if($errors->has('sistolik'))has-error @endif">
			{!! Form::label('sistolik', 'Sistolik', ['class' => 'control-label']) !!}
			@if( isset($periksa) )
				{!! Form::text('sistolik', $periksa->sistolik, array(
					'class'         => 'form-control rq'
				))!!}
			@else
				{!! Form::text('sistolik', $nurse_station->sistolik, array(
					'class'         => 'form-control rq'
				))!!}
			@endif
			@if($errors->has('sistolik'))<code>{{ $errors->first('sistolik') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group @if($errors->has('diastolik'))has-error @endif">
			{!! Form::label('diastolik', 'Diastolik', ['class' => 'control-label']) !!}
			@if( isset($periksa) )
				{!! Form::text('diastolik', $periksa->diastolik, array(
					'class'         => 'form-control rq'
				))!!}
			@else
				{!! Form::text('diastolik', $nurse_station->diastolik, array(
					'class'         => 'form-control rq'
				))!!}
			@endif
			@if($errors->has('diastolik'))<code>{{ $errors->first('diastolik') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group @if($errors->has('berat_badan'))has-error @endif">
			{!! Form::label('berat_badan', 'Berat Badan', ['class' => 'control-label']) !!}
			@if( isset($periksa) )
				{!! Form::text('berat_badan', $periksa->berat_badan, array(
					'class'         => 'form-control rq'
				))!!}
			@else
				{!! Form::text('berat_badan', $nurse_station->berat_badan, array(
					'class'         => 'form-control rq'
				))!!}
			@endif
			@if($errors->has('berat_badan'))<code>{{ $errors->first('berat_badan') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('pemeriksaan_penunjang'))has-error @endif">
		  {!! Form::label('pemeriksaan_penunjang', 'Pemeriksaan Penunjang/Tindakan', ['class' => 'control-label']) !!}
			@if( isset($periksa) )
				<a href="{{ url('home/transaksi_periksas/' . $periksa->nurse_station_id . '/create') }}">Tambah</a>
			@else
				  <a href="{{ url('home/transaksi_periksas/' . $nurse_station->id . '/create') }}">Tambah</a>
			@endif
		  <div class="table-responsive">
		  	<table class="table table-hover table-condensed table-bordered">
		  		<thead>
		  			<tr>
		  				<th>Tindakan</th>
		  				<th>Keterangan</th>
		  			</tr>
		  		</thead>
		  		<tbody>
					@if( isset($periksa) )
						@include('periksas.tableTransaksi', ['transaksi' => $periksa->transaksiPeriksa])
					@else
						@include('periksas.tableTransaksi', ['transaksi' => $nurse_station->transaksi])
					@endif
		  		</tbody>
		  	</table>
		  </div>
		  
		  @if($errors->has('pemeriksaan_penunjang'))<code>{{ $errors->first('pemeriksaan_penunjang') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('diagnosa_id'))has-error @endif">
		  {!! Form::label('diagnosa_id', 'Diagnosa', ['class' => 'control-label']) !!}
					@if( isset($periksa) )
						<a href="{{ url('home/diagnosas/' . $periksa->nurse_station_id . '/create') }}">Tidak dapat menemukan diagnosa?</a>
					@else
						<a href="{{ url('home/diagnosas/' . $nurse_station->id . '/create') }}">Tidak dapat menemukan diagnosa?</a>
					@endif
			{!! Form::select('diagnosa_id', App\Diagnosa::selectList(), null, array(
				'class'         => 'form-control selectpick rq',
				'data-live-search'         => 'true'
			))!!}
		  @if($errors->has('diagnosa_id'))<code>{{ $errors->first('diagnosa_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('keterangan_diagnosa'))has-error @endif">
		  {!! Form::label('keterangan_diagnosa', 'Keterangan Diagnosa / dd / Diagnosa Lain', ['class' => 'control-label']) !!}
			{!! Form::text('keterangan_diagnosa', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('keterangan_diagnosa'))<code>{{ $errors->first('keterangan_diagnosa') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if(isset($daftar))
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Terapi</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/daftars') }}">Cancel</a>
			</div>
		@else
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Terapi</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/pasiens') }}">Cancel</a>
			</div>
		@endif
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
</div>
