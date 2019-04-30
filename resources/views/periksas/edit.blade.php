@extends('layout.master')

@section('title') 

	Online Electronic Medical Record | Edit Pemeriksaan {{ ucfirst( $periksa->poli ) }} 

@stop
@section('page-title') 
<h2>Edit Pemeriksaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
		<a href="{{ url('home/polis/' . $periksa->nurseStation->poli_id)}}">{{ ucfirst( $periksa->poli ) }}</a>
	  </li>
	  <li class="active">
		  <strong>Pemeriksaan {{ $periksa->pasien->nama }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::model($periksa,['url' => 'home/periksas', 'method' => 'post']) !!}
		@include('periksas.form')
	{!! Form::close() !!}
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
