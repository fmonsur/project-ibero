var tabla;

function init() {
	listarDivisa();

}

function listarDivisa(){
	tabla=$('#tbl_divisa').dataTable({
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
			url:'../../controller/divisa.php?op=listarDivisa',
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