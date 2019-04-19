@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Tarif

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Tarif</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Tarif</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/tarifs/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Tarif Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tarif</th>
							<th></th>
							<th>No Telp</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($tarifs->count() > 0)
							@foreach($tarifs as $asuransi)
								<tr>
									<td>{{ $asuransi->id }}</td>
									<td>{{ $asuransi->nama_asuransi }}</td>
									<td>{{ $asuransi->no_telp }}</td>
									<td>{{ $asuransi->alamat }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/tarifs/' . $asuransi->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/tarifs/' . $asuransi->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $asuransi->id }} - {{ $asuransi->nama_asuransi }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/tarifs/imports', 'method' => 'post', 'files' => 'true']) !!}
										<div class="form-group">
											{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
											{!! Form::file('file') !!}
											{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
										</div>
									{!! Form::close() !!}
								</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
@stop
@section('footer') 
	
@stop

