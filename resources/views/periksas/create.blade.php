@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Pemeriksaan {{ ucfirst( $nurse_station->poli->poli ) }} 

@stop
@section('page-title') 
<h2>Pemeriksaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
			<a href="{{ url('home/polis/' . $nurse_station->poli_id)}}">{{ ucfirst( $nurse_station->poli->poli ) }}</a>
	  </li>
	  <li class="active">
		  <strong>Pemeriksaan {{ $nurse_station->pasien->nama }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open(['url' => 'home/periksas', 'method' => 'post']) !!}
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
