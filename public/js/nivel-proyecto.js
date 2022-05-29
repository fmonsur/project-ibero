var tabla;

function init() {
	listarNivelesProyecto();
}

// function nuevoCliente(e) {
// 	e.preventDefault();
// 	var formData = new FormData($("#frm_nuevo_cliente")[0]);
// 	$.ajax({
// 		url: "../../controller/gestionar-cliente.php?op=nuevoCliente",
// 		type: "POST",
// 		data: formData,
// 		contentType: false,
// 		processData: false,
// 		success: function(data){
// 			data = JSON.parse(data);
// 			Swal.fire({
// 				icon: data.icon,
// 				title: data.title ,
// 				text:data.text,
// 			}).then((result) => {
// 				limpiarCampos();
			
// 			});
// 		}
// 	});
	
// }

// function limpiarCampos(){
// 	$('#nombre').val('');
// 	$('#porcentaje_comision').val('');
// 	$('#porcentaje_anticipo').val('');
// }

function listarNivelesProyecto(){
	tabla=$('#tbl_porcentajes_operativos').dataTable({
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
			url:'../../controller/nivel-proyecto.php?op=listarNivelesProyecto',
			type: "post",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"asc"]]
	}).DataTable();  
}
init();