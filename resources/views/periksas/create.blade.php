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
	<table class="hide" >
		<tbody id="tarif_temp">
			@include('periksas.tindakan', ['tindakan' => null])
		</tbody>
	</table>
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">


		$('#tindakan_table').find('select').val('1')
                .selectpicker({
                style: 'btn-default',
                size: 10,
                selectOnTab : true,
                style : 'btn-white'
            }).closest('tr').find('button').removeClass('disabled');


		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function addTindakan(control){
			var tindakan_temp = $('#tarif_temp').html();
			$('#tindakan_table').append(tindakan_temp);
			$(control).closest('tr').next().find('select')
                .selectpicker({
                style: 'btn-default',
                size: 10,
                selectOnTab : true,
                style : 'btn-white'
            });
			$(control).find('.glyphicon-plus')
				.removeClass('glyphicon-plus')
				.addClass('glyphicon-minus');
			$(control)
				.removeClass('btn-success')
				.addClass('btn-danger')
				.attr('onclick', 'rowDel(this);return false;');
		}
		function rowDel(control){
			$(control).closest('tr').remove();
		}
		function tarifSelectChange(control){
			var selectVal = $(control).val();
			console.log(selectVal);
			var $button = $(control).closest('tr').find('button');
			if( !selectVal ){
				if( !$button.hasClass('disabled') ){
					$button.addClass('disabled');
				}
			} else {
				if( $button.hasClass('disabled') ){
					$button.removeClass('disabled');
				}
			}
		}
	</script>
@stop
