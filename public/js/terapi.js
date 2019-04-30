var array;
var data;
var puyer = false;
var add = false;
var finishPuyer = false;
var finishAdd = false;
var obatPuyer = false;
var obatStandar = true;
var obatAdd = false;
setTimeout(function(){
	focusObat();
}, 500);
function inputResep(control){
	if (inputNotEmpty()) {
		if ( $('#json_container').val() == ''  ) {
			$('#json_container').val('[]');
		}
		collectData();
		pushData();
		viewResep();
		clearSelection();
	}
}

function collectData(){
	data = {
		'tipe_resep_id':        $('#tipe_resep').val(),
		'standar_text':      $('#tipe_resep option:selected').text(),
		'obat_id':           $('#obat').val(),
		'obat_text':         $('#obat option:selected').text(),
		'signa_id':          $('#signa').val(),
		'signa_text':        $('#signa option:selected').text(),
		'aturan_minum_id':   $('#aturan_minum').val(),
		'aturan_minum_text': $('#aturan_minum option:selected').text(),
		'jumlah':            $('#jumlah').val()
	};
}

function clearSelection(){
	$('#obat').val('').selectpicker('refresh');
	if ( !puyer && !add ) {
		$('#signa').val('1').selectpicker('refresh');
		$('#aturan_minum').val('').selectpicker('refresh');
		$('#jumlah').val('');
	}
	focusObat();
}
function pushData(){
	array = JSON.parse( $('#json_container').val() );
	array.push(data);
}

function viewResep(){
	puyer       = false;
	add         = false;
	var temp = '';
	for (var i = 0, len = array.length; i < len; i++) {
		if ( array[i].tipe_resep_id == '1' ) { // tipe resep tipe_resep
			console.log('obatPuyer level 1');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td>R/</td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].signa_text+ '</td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].aturan_minum_text+ '</td>';
			temp += '<td></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '3' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '3' ) && ( array[i].obat_id == '1' || array[i].obat_id == '3' )  ){
			console.log('obatPuyer level 2');
			console.log(obatPuyer);
			finishPuyer = true;
			puyer       = false;
			add         = false;
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td style="border-bottom:1px solid #000;">Buat menjadi ' + array[i].jumlah + ' puyer</td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].aturan_minum_text+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '3' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '3' )){
			kondisikanSeleksiPuyer();
			console.log('obatPuyer level 3');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '3' ){
			kondisikanSeleksiPuyer();
			console.log('obatPuyer level 4');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td>R/</td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '2' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '2' ) && array[i].obat_id == '2'  ){
			finishAdd   = true;
			finishPuyer = false;
			puyer       = false;
			add         = false;
			console.log('obatPuyer level 5');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td style="border-bottom:1px solid #000;">S masukkan ke dalam sirup  ' + array[i].signa_text + '</td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].aturan_minum_text+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '2' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '2' )){
			kondisikanSeleksiAdd();
			console.log('obatPuyer level 6');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '2' ){
			kondisikanSeleksiAdd();
			console.log('obatPuyer level 7');
			console.log(obatPuyer);
			if (!obatPuyer) {
				obatPuyer = true;
				gantiObatKeKapsulDanTablet();
			}
			temp += '<tr>';
			temp += '<td>R/</td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>fls No. ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
			temp += '<tr>';
			temp += '<td colspan="3" style="text-align:center">ADD</td>';
			temp += '<td></td>';
			temp += '</tr>';
		}
	}
	ubahFormatSelection();
	$('#resep').html(temp);
	var json = JSON.stringify(array);
	$('#json_container').val(json);
}
function rowDel(i){
	array.splice(i,1);
	viewResep();
}
function tipeResepChange(control){
	
	if ( $(control).val() == '3' ) {
		kondisikanSeleksiPuyer();
		gantiSeleksiPuyer();
	} else if ( $(control).val() == '2' ) {
	obatPuyer   = false;
		kondisikanSeleksiAdd();
		gantiSeleksiAdd();
	}
	focusObat();
}
function inputNotEmpty(){
	if(
        $('#tipe_resep').val()   == '' ||
		$('#obat').val()         == '' ||
		$('#jumlah').val()       == '' ||
		$('#aturan_minum').val() == '' ||
		$('#signa').val()        == ''
	){
		alert('input harus diisi semua');
		focusObat();
		return false;
	}
	return true;
}

function focusObat(){
	$('#obat').closest('.form-group').find('.dropdown-toggle').focus();
}

function endPuyer(){
	$('#selesaikanPuyer').fadeOut('slow');
	$('#obat').val('1').attr("disabled", true).selectpicker('refresh');
	$('#signa').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#aturan_minum').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#jumlah').val('').focus();

}
function endAdd(){
	$('#selesaikanAdd').fadeOut('slow');
	$('#obat').val('2').selectpicker('refresh').closest('.form-group').fadeOut('slow');
	$('#signa').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#aturan_minum').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#jumlah').val('0').fadeOut('slow');
	$('#signa').closest('.form-group').find('.dropdown-toggle').focus();

}
function isset(ref) { return typeof ref !== 'undefined' }
function ubahFormatSelection(){
	if (puyer) {
		gantiSeleksiPuyer();
		focusObat();
	} else if( add ){
		gantiSeleksiAdd();
		focusObat();
	} else {
		gantiSeleksiStandar();
	}
}
function gantiSeleksiPuyer(){
	obatAdd   = false;
	obatStandar = false;
	if ( $('#tipe_resep').closest('.form-group').is(':visible') ) {
		$('#tipe_resep').closest('.form-group').fadeOut('slow', function(){
			if ( $('#selesaikanPuyer').is(':hidden') ) {
				$('#selesaikanPuyer').fadeIn('slow');
			}
			if ( $('#selesaikanAdd').is(':visible') ) {
				$('#selesaikanPuyer').fadeOut('slow');
			}
		});
	}
	if (!obatPuyer) {
		obatPuyer = true;
		gantiObatKeKapsulDanTablet();
	}

	$('#signa').val(2);
	if ( $('#signa').closest('.form-group').is(':visible') ) {
		$('#signa').closest('.form-group').fadeOut('slow');
	}

	$('#aturan_minum').val(1)
	if ( $('#aturan_minum').closest('.form-group').is(':visible') ) {
		$('#aturan_minum').closest('.form-group').fadeOut('slow');
	}
	if ( $('#obat').closest('.form-group').is(':hidden') ) {
		$('#obat').closest('.form-group').fadeIn('slow');
	}
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
}
function gantiSeleksiAdd(){
	obatStandar = false;
	if ( $('#tipe_resep').closest('.form-group').is(':visible') ) {
		$('#tipe_resep').closest('.form-group').fadeOut('slow', function(){
			if ( $('#selesaikanPuyer').is(':visible') ) {
				$('#selesaikanPuyer').fadeOut('slow');
			}
			if ( $('#selesaikanAdd').is(':hidden') ) {
				$('#selesaikanAdd').fadeIn('slow');
			}
		});
	}
	if (!obatAdd) {
		obatAdd = true;
		$.get( url + '/home/terapis/jenis_obat_add',
			{},
			function (data, textStatus, jqXHR) {
				var temp ='<option value="">Nama Obat</option>';
				for (var i = 0, len = data.length; i < len; i++) {
					temp += '<option value="' +data[i].value+ '">' +data[i].text+ '</option>';
				}
				$('#obat').html(temp).selectpicker('refresh');
			}
		);
	}

	$('#signa').val(2);
	if ( $('#signa').closest('.form-group').is(':visible') ) {
		$('#signa').closest('.form-group').fadeOut('slow');
	}

	$('#aturan_minum').val(1)
	if ( $('#aturan_minum').closest('.form-group').is(':visible') ) {
		$('#aturan_minum').closest('.form-group').fadeOut('slow');
	}
	if ( $('#obat').closest('.form-group').is(':hidden') ) {
		$('#obat').closest('.form-group').fadeIn('slow');
	}
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
}
function gantiSeleksiStandar(){
	obatPuyer = false;
	obatAdd   = false;
	$('#tipe_resep').val('1').selectpicker('refresh');
	if ( $('#tipe_resep').closest('.form-group').is(':hidden') ) {
		$('#tipe_resep').closest('.form-group').fadeIn('slow', function(){
			if ( $('#selesaikanPuyer').is(':visible') ) {
				$('#selesaikanPuyer').fadeOut('slow');
			}
			if ( $('#selesaikanAdd').is(':visible') ) {
				$('#selesaikanAdd').fadeOut('slow');
			}
		});
	}
	if ( $('#selesaikanPuyer').is(':visible') ) {
		$('#selesaikanPuyer').fadeOut('slow');
	}
	if ( $('#selesaikanAdd').is(':visible') ) {
		$('#selesaikanPuyer').fadeOut('slow');
	}
	if (!obatStandar) {
		obatStandar = true;
		$.get( url + '/home/terapis/jenis_obat_standar',
			{},
			function (data, textStatus, jqXHR) {
				var temp ='<option value="">Nama Obat</option>';
				for (var i = 0, len = data.length; i < len; i++) {
					temp += '<option value="' +data[i].value+ '">' +data[i].text+ '</option>';
				}
				$('#obat').html(temp).selectpicker('refresh');
			}
		);
	}

	$('#signa').val('');
	if ( $('#signa').closest('.form-group').is(':hidden') ) {
		$('#signa').closest('.form-group').fadeIn('slow');
	}
	$('#aturan_minum').val('')
	if ( $('#aturan_minum').closest('.form-group').is(':hidden') ) {
		$('#aturan_minum').closest('.form-group').fadeIn('slow');
	}
	if ( $('#obat').closest('.form-group').is(':hidden') ) {
		$('#obat').closest('.form-group').fadeIn('slow');
	}
	$('#obat').attr("disabled", false).selectpicker('refresh');
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
}
function kondisikanSeleksiPuyer(){
	finishPuyer = false;
	puyer       = true;
	add         = false;
}
function kondisikanSeleksiAdd(){
	finishPuyer = false;
	puyer       = false;
	add         = true;
}
function gantiObatKeKapsulDanTablet(){
	$.get( url + '/home/terapis/jenis_obat_puyer',
		{},
		function (data, textStatus, jqXHR) {
			var temp ='<option value="">Nama Obat</option>';
			for (var i = 0, len = data.length; i < len; i++) {
				temp += '<option value="' +data[i].value+ '">' +data[i].text+ '</option>';
			}
			$('#obat').html(temp).selectpicker('refresh');
		}
	);
}
