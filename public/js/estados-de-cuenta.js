var tabla;

function init() {
	listarProyectos();
}


function listarProyectos(){
	tabla=$('#tbl_gestionar_proyectos').dataTable({
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
			url:'../../controller/estados-de-cuenta.php?op=listarProyectos',
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

function eliminarProyecto(id_proyecto) {
	Swal.fire({
		title: 'Estas seguro?',
		text: "Si eliminas el proyecto no podras recuperarlo",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, estoy seguro!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.post('../../controller/estados-de-cuenta.php?op=eliminarProyecto',
				{id_proyecto:id_proyecto},
				(data)=>{
					data = JSON.parse(data);
					// console.log(data);	
					tabla.ajax.reload();
					Swal.fire({
						icon: data.icon,
						title: data.title,
						text: data.text
					});
				});

		}
	})
}

init();