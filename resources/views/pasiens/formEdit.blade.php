<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nama')) has-error @endif">
		  {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
		  {!! Form::text('nama' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('alamat'))has-error @endif">
		  {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
			{!! Form::textarea('alamat', null, array(
				'class'         => 'form-control textareacustom rq'
			))!!}
		  @if($errors->has('alamat'))<code>{{ $errors->first('alamat') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('no_telp'))has-error @endif">
		  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
			{!! Form::text('no_telp', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('asuransi_id'))has-error @endif">
		  {!! Form::label('asuransi_id', 'Asuransi', ['class' => 'control-label']) !!}
			{!! Form::select('asuransi_id', $asuransis, null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('asuransi_id'))<code>{{ $errors->first('asuransi_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('nomor_asuransi'))has-error @endif">
		  {!! Form::label('nomor_asuransi', 'Nomor Asuransi', ['class' => 'control-label']) !!}
			{!! Form::text('nomor_asuransi', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('nomor_asuransi'))<code>{{ $errors->first('nomor_asuransi') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('nama_peserta'))has-error @endif">
			{!! Form::label('nama_peserta', 'Nama Peserta', ['class' => 'control-label']) !!}
			{!! Form::text('nama_peserta', null, array(
				'class'         => 'form-control'
			))!!}
			@if($errors->has('nama_peserta'))<code>{{ $errors->first('nama_peserta') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('no_ktp'))has-error @endif">
		  {!! Form::label('no_ktp', 'Nomor KTP', ['class' => 'control-label']) !!}
			{!! Form::text('no_ktp', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('no_ktp'))<code>{{ $errors->first('no_ktp') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('jenis_peserta_id'))has-error @endif">
		  {!! Form::label('jenis_peserta_id', 'Jenis Peserta', ['class' => 'control-label']) !!}
			{!! Form::select('jenis_peserta_id', \App\JenisPeserta::pluck('jenis_peserta', 'id'), null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('jenis_peserta_id'))<code>{{ $errors->first('jenis_peserta_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('sex'))has-error @endif">
		  {!! Form::label('sex', 'Jenis Kelamin', ['class' => 'control-label']) !!}
			{!! Form::select('sex', \App\Yoga::jenisKelaminList(), null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('sex'))<code>{{ $errors->first('sex') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('tanggal_lahir'))has-error @endif">
		  {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'control-label']) !!}
		  @if(isset($edit))
			  {!! Form::text('tanggal_lahir', App\Yoga::updateDatePrep($pasien->tanggal_lahir), array( 'class'         => 'form-control tanggal'))!!}
			@else
			{!! Form::text('tanggal_lahir', null, array( 'class'         => 'form-control tanggal'))!!}
			@endif
		  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('nama_ayah'))has-error @endif">
		  {!! Form::label('nama_ayah', 'Nama Ayah', ['class' => 'control-label']) !!}
			{!! Form::text('nama_ayah', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('nama_ayah'))<code>{{ $errors->first('nama_ayah') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('nama_ibu'))has-error @endif">
		  {!! Form::label('nama_ibu', 'Nama Ibu', ['class' => 'control-label']) !!}
			{!! Form::text('nama_ibu', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('nama_ibu'))<code>{{ $errors->first('nama_ibu') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('email'))has-error @endif">
		  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
			{!! Form::text('email', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('bpjs_image'))has-error @endif">
		  {!! Form::label('bpjs_image', 'Kartu BPJS', ['class' => 'control-label']) !!}
			{!! Form::text('bpjs_image', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('bpjs_image'))<code>{{ $errors->first('bpjs_image') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('ktp_image'))has-error @endif">
		  {!! Form::label('ktp_image', 'Gambar KTP', ['class' => 'control-label']) !!}
			{!! Form::text('ktp_image', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('ktp_image'))<code>{{ $errors->first('ktp_image') }}</code>@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="form-group @if($errors->has('image'))has-error @endif">
		  {!! Form::label('image', 'Foto Pasien', ['class' => 'control-label']) !!}
			{!! Form::text('image', null, array(
				'class'         => 'form-control'
			))!!}
		  @if($errors->has('image'))<code>{{ $errors->first('image') }}</code>@endif
		</div>
	</div>
</div>

{!! Form::text('random_string', $random_string, array(
	'class'         => 'form-control'
))!!}
<div class="row">
	@if(isset($pasien))
	{!! Form::open(['url' => 'home/pasien/' . $pasien->id, 'method' => 'delete']) !!}
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<button class="btn btn-warning btn-block" onclick="return confirm('Anda yakin ingin menghapus {{ $pasien->id }} - {{  $pasien->nama  }} ?')" type="submit">Delete</button>
		</div>
	{!! Form::close() !!}
	@else
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
		</div>
	@endif
</div>
