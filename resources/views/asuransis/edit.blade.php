@extends('layout.master')

@section('title') 
PPDS DV | 

@stop
@section('breadcrumb') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
		<li>
		  <a href="{{ url('home/asuransis')}}">Asuransi</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Asuransi</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($asuransi,['url' => 'home/asuransis/' .  $asuransi->id, 'method' => 'put']) !!}
						@include('asuransis.form', ['update' => true])
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
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
