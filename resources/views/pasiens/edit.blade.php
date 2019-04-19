@extends('layout.master')

@section('head') 
	<link href="{!! asset('css/poli.css') !!}" rel="stylesheet">
@stop

@section('title') 

Online Electronic Medical Record | Pasien

@stop
@section('page-title') 
<h2>Edit Pasien</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/pasiens')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Edit Pasien
					</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($pasien,['url' => 'home/pasiens/' . $pasien->id, 'method' => 'put']) !!}
					@include('pasiens.formEdit')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	@include('images.barcode')
@stop
@section('footer') 
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
</script> 
@stop

