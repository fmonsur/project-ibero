var tabla;

function init() {
	totalesRetiro();
	listarCanjes();
	$("#frm_nuevo_cambio").on("submit",function(e){
		nuevoCambio(e);
	})
}

function nuevoCambio(e) {
	e.preventDefault();
	var formData = new FormData($("#frm_nuevo_cambio")[0]);
	$.ajax({
		url: "../../controller/gestionar-cambios.php?op=nuevoCambio",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function(data){
			data = JSON.parse(data);
			Swal.fire({
				icon: data.icon,
				title: data.title ,
				text:data.text,
			}).then((result) => {
				limpiarCampos();
				totalesRetiro();

			});
		}
	});
	
}

function limpiarCampos(){
	$('#fecha').val('');
	$('#cantidad_usd').val('');
	$('#cambio_cop').val('');
	$('#detalle').val('');
}

function totalesRetiro() {
	$.post('../../controller/gestionar-cambios.php?op=totalesRetiro', function (data) {
		data = JSON.parse(data);
		$('#lbl_cantidad_usd').html('$ '+number_format(data.cantidad_usd,0));
		$('#lbl_cambio_cop').html('$ '+number_format(data.cambio_cop,0));
		$('#lbl_tasa').html('$ '+number_format(data.tasa,3));
	});
}

function listarCanjes(){
	tabla=$('#tbl_canjes').dataTable({
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
		},
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [{
			extend: 'excelHtml5',
			title: 'listado_de_canjes',
			text: 'Exportar (xls)',
			sheetName: 'Listado de canjes'
		}],
		"ajax":{
			url:'../../controller/gestionar-cambios.php?op=listarCanjes',
			type: "post",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"desc"]]
	}).DataTable();  
}


function verProyecto(id_proyecto) {
	window.location.href = '../proyecto/?id_proyecto='+id_proyecto;
}
init();