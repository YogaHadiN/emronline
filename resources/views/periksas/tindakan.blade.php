<tr>
	<td>
		@if( isset($tindakan) )
			{!! Form::select('tindakans[]', App\Tarif::selectList( $nurse_station->asuransi_id ), $tindakan->id, [
				'class'            => 'form-control tarif_select',
				'placeholder'      => '- Pilih Tindakan -',
				'onchange'         => 'tarifSelectChange(this);return false;',
				'data-live-search' => 'true'
			]) !!}
		@else
			{!! Form::select('tindakans[]', App\Tarif::selectList( $nurse_station->asuransi_id ), null, [
				'class'            => 'form-control tarif_select',
				'onchange'         => 'tarifSelectChange(this);return false;',
				'placeholder'      => '- Pilih Tindakan -',
				'data-live-search' => 'true'
			]) !!}
		@endif
	</td>
	<td>
		{!! Form::text('keterangan_tindakans[]', null, ['class' => 'form-control']) !!}
	</td>
	<td>
		@if( isset($tindakans) && isset($k) && $k == count($tindakans) -1 )
			<button class="btn btn-danger btn-sm" type="button" onclick="rowDel(this);return false;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
		@else
			<button class="btn btn-primary btn-sm disabled" type="button" onclick="addTindakan(this);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
		@endif
	</td>
</tr>
