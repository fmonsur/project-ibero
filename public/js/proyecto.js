var tbl_arte;
var tbl_extra_arte;
var tbl_animacion;
var tbl_extra_animacion;
var tbl_sonido;
var id_proyecto = $('#id_proyecto').val();
var id_usuario_proyecto_forja = $.ajax({ type: "POST",url: "../../controller/proyecto.php?op=obtenerIdUsuarioProyectoForja",data:{id_proyecto:id_proyecto},async: false,}).responseText;

function init() {
	$("#cambiar-seleccion").hide();
	$('#contenedor_mensaje_error').hide();
	cargarTablaArte();
	cargarTablaAnimacion();
	cargarTablaExtraSonido();
	cargarTablaExtraArte();
	cargarTablaExtraAnimacion();
	verProyectoPorId(id_proyecto);
	

	$("#div_arte").hide();
	$("#div_animacion").hide();
	$("#div_sonido").hide();
	$("#div_extra_arte").hide();
	$("#div_extra_animacion").hide();


	$.post("../../controller/proyecto.php?op=selectEstados", function(data){
		$("#id_estado").html(data);
		$("#id_estado").selectpicker('refresh');
	});

}

function cargarSelectArte(){
	$.post("../../controller/proyecto.php?op=selectUsuarioPorPerfil",{id_perfil:2}, function(data){
		$("#direccion_arte").html(data);
		$("#direccion_arte").selectpicker('refresh');
	});
	$.post("../../controller/proyecto.php?op=selectUsuarioPorPerfil",{id_perfil:5}, function(data){
		$("#artistas").html(data);
		$("#artistas").selectpicker('refresh');
	});

	// $("#seccion_arte").show();
	// $("#select_artistas").show();
}

function cargarSelectAnimacion(){
	$.post("../../controller/proyecto.php?op=selectUsuarioPorPerfil",{id_perfil:3}, function(data){
		$("#direccion_animacion").html(data);
		$("#direccion_animacion").selectpicker('refresh');
	});
	$.post("../../controller/proyecto.php?op=selectUsuarioPorPerfil",{id_perfil:6}, function(data){
		$("#animadores").html(data);
		$("#animadores").selectpicker('refresh');
	});
	// $("#seccion_animacion").show();
	// $("#select_animadores").show();
}

function cargarSelectDirSonido(){
	// $.post("../../controller/proyecto.php?op=selectUsuarioPorPerfil",{id_perfil:4}, function(data){
	// 	$("#direccion_sonido").html(data);
	// 	$("#direccion_sonido").selectpicker('refresh');
	// });
	$.post("../../controller/proyecto.php?op=selectUsuarioPorPerfil",{id_perfil:7}, function(data){
		$("#sonidistas").html(data);
		$("#sonidistas").selectpicker('refresh');
	});
	// $("#seccion_sonido").show();
	// $("#select_sonidistas").show();
}






function verProyectoPorId(id_proyecto) {
	$.post('../../controller/proyecto.php?op=verProyectoPorId',
		{id_proyecto:id_proyecto},
		(data)=>{
			data = JSON.parse(data);
			// console.log(data);
			$('#lbl_nombre').html(data.nombre);

			let id_cliente = data.id_cliente;
			$.post('../../controller/proyecto.php?op=nombreCliente',{id_cliente:id_cliente},(data_cli)=>{
				data_cli = JSON.parse(data_cli);
				$('.lbl_nombre_cliente').html(data_cli);
				// console.log(data_cli);
			});

			let id_moneda = data.id_moneda;
			$.post('../../controller/proyecto.php?op=nombreDivisa',{id_moneda:id_moneda},(data_div)=>{
				data_div = JSON.parse(data_div);
				$('.lbl_nombre_moneda').html(data_div);
				// console.log(data_div);
			});
			// =====================================================================
			// Mostrar los div de configuración del proyecto
			// =====================================================================
			if (data.valor_arte != 0) {
				cargarSelectArte();		
				$("#div_arte").show();
			}
			if (data.valor_animacion != 0) {
				cargarSelectAnimacion();
				$("#div_animacion").show();
			}
			if (data.valor_extra_sonido != 0) {
				cargarSelectDirSonido();
				$("#div_sonido").show();
			}
			if (data.valor_extra_arte != 0) {
				$("#div_extra_arte").show();
			}
			if (data.valor_extra_animacion != 0) {
				$("#div_extra_animacion").show();		
			}

			$('.lbl_nivel').html(data.nivel);
			$('.lbl_valor_proyecto').html('$ '+ number_format(data.valor_proyecto));
			$('.lbl_porcentaje_comision').html(number_format(data.porcentaje_comision,2)+' %');
			$('.lbl_valor_proyecto_comision').html('$ '+ number_format(data.valor_proyecto_comision,2));
			$('.lbl_valor_proyecto_menos_comision').html('$ '+ number_format(data.valor_proyecto_menos_comision,2));
			$('.lbl_valor_avance').html('$ '+ number_format(data.valor_avance,2));
			$('.lbl_valor_avance_comision').html('$ '+ number_format(data.valor_avance_comision,2));
			$('.lbl_valor_final_proyecto').html('$ '+ number_format(data.valor_final_proyecto,2));
			$('.lbl_porcentaje_administrativo').html(number_format(data.porcentaje_administrativo,2)+' %');
			$('.lbl_porcentaje_operativo').html(number_format(data.porcentaje_operativo,2)+' %');
			$('.lbl_valor_adminstrativo').html('$ '+ number_format(data.valor_adminstrativo,2));
			$('.lbl_valor_operativo').html('$ '+ number_format(data.valor_operativo,2));
			$('.lbl_valor_tip').html('$ '+ number_format(data.valor_tip,2));
			$('.lbl_porcentaje_tip_arte').html(number_format(data.porcentaje_tip_arte,2)+' %');
			$('.lbl_porcentaje_tip_animacion').html(number_format(data.porcentaje_tip_animacion,2)+' %');
			$('.lbl_porcentaje_tip_sonido').html(number_format(data.porcentaje_tip_sonido,2)+' %');
			$('.lbl_porcentaje_arte').html(number_format(data.porcentaje_arte,2)+' %');
			$('.lbl_valor_arte').html('$ '+ number_format(data.valor_arte,2));
			$('.lbl_valor_tip_arte').html('$ '+ number_format(data.valor_tip_arte,2));
			$('.lbl_valor_arte_final').html('$ '+ number_format(data.valor_arte_final,2));
			$('.lbl_porcenteje_animacion').html(number_format(data.porcenteje_animacion,2)+' %');
			$('.lbl_valor_animacion').html('$ '+ number_format(data.valor_animacion,2));
			$('.lbl_valor_tip_animacion').html('$ '+ number_format(data.valor_tip_animacion,2));
			$('.lbl_valor_animacion_final').html('$ '+ number_format(data.valor_animacion_final,2));
			$('.lbl_valor_extra_arte').html('$ '+ number_format(data.valor_extra_arte,2));
			$('.lbl_valor_extra_arte_comision').html('$ '+ number_format(data.valor_extra_arte_comision,2));
			$('.lbl_valor_extra_arte_comision_adelanto').html('$ '+ number_format(data.valor_extra_arte_comision_adelanto,2));
			$('.lbl_valor_extra_arte_final').html('$ '+ number_format(data.valor_extra_arte_final,2));
			$('.lbl_valor_extra_animacion').html('$ '+ number_format(data.valor_extra_animacion,2));
			$('.lbl_valor_extra_animacion_comision').html('$ '+ number_format(data.valor_extra_animacion_comision,2));
			$('.lbl_valor_extra_animacion_comision_adelanto').html('$ '+ number_format(data.valor_extra_animacion_comision_adelanto,2));
			$('.lbl_valor_extra_animacion_final').html('$ '+ number_format(data.valor_extra_animacion_final,2));
			$('.lbl_valor_extra_sonido').html('$ '+ number_format(data.valor_extra_sonido,2));
			$('.lbl_valor_extra_sonido_comision').html('$ '+ number_format(data.valor_extra_sonido_comision,2));
			$('.lbl_valor_extra_sonido_adelanto').html('$ '+ number_format(data.valor_extra_sonido_adelanto,2));
			$('.lbl_valor_tip_sonido').html('$ '+ number_format(data.valor_tip_sonido,2));
			$('.lbl_valor_extra_sonido_final').html('$ '+ number_format(data.valor_extra_sonido_final,2));
			$('.lbl_fecha_inicio').html(data.fecha_inicio);
			$('.lbl_fecha_posible_fin').html(data.fecha_posible_fin);

			$('#valor_extra_animacion_final').val(data.valor_extra_animacion_final);
			$('#valor_extra_arte_final').val(data.valor_extra_arte_final);
			$('#valor_extra_sonido_final').val(data.valor_extra_sonido_final);
			$('#total_valor_animacion').val(data.valor_animacion_final);
			$('#total_valor_arte').val(data.valor_arte_final);
			$('#valor_adminstrativo').val(data.valor_adminstrativo);
			$('#id_cliente').val(data.id_cliente);
			$('#nivel').val(data.nivel);
			$('#valor_proyecto').val(data.valor_proyecto);
			$('#valor_final_proyecto').val(data.valor_final_proyecto);

			$('#valor_avance').val(data.valor_avance);
			if (data.valor_avance == 1) {
				$("#check_anticipo").prop("checked",true);
			}
		});
}


function calcularProyecto(){
	let id_cliente = $('#id_cliente').val();
	let nivel = $('#nivel').val();
	let valor_proyecto = $('#valor_proyecto').val();
	let check_anticipo;
	let valor_avance = $('#valor_avance').val();

	if( $('#check_anticipo').is(':checked') ) {
		check_anticipo = 1;
	}else{
		check_anticipo = 0;
	}

	if (valor_avance == check_anticipo){
		// alert('Cambie si selección');
		$("#cambiar-seleccion").show(500);
	}else{

		$.post('../../controller/proyecto.php?op=calcularProyectoV2',{
			id_proyecto:id_proyecto,
			id_cliente:id_cliente, 
			nivel:nivel, 
			valor_proyecto:valor_proyecto,
			check_anticipo:check_anticipo
		},(data)=>{
			data = JSON.parse(data);
			Swal.fire({
				icon: data.icon,
				title: data.title ,
				text:data.text,
				footer: data.footer
			}).then((result) => {
				location.reload();
			});
			console.log(data);
		});
	}
}


function validarAdelanto() {
	let valor_final_proyecto = $('#valor_final_proyecto').val();
	var adelanto_disponible = $.ajax({ type: "POST",url: "../../controller/proyecto.php?op=validarAdelanto",async: false,}).responseText;
	if (parseFloat(valor_final_proyecto) > parseFloat(adelanto_disponible)) {
		Swal.fire({
			title: 'Estas seguro?',
			text: "El valor del adelanto supera el valor disponible",
			icon: 'info',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, seguro!'
		}).then((result) => {
			if (result.isConfirmed) {
				calcularProyecto();
			}
		})
	}else{
		calcularProyecto();
	}
}

function btnAgregarUsuario(input,perfil) {
	let id_usuario_proyecto = $(input).val();
	insertarUsuarioProyecto(id_usuario_proyecto, perfil);
}

function insertarUsuarioProyecto(id_usuario_proyecto, id_perfil) {
	$.post("../../controller/proyecto.php?op=insertarUsuarioProyecto",{
		id_proyecto:id_proyecto,
		id_usuario_proyecto:id_usuario_proyecto,
		id_perfil:id_perfil,
	}, function(data){
		tbl_arte.ajax.reload();
		tbl_animacion.ajax.reload();
		tbl_sonido.ajax.reload();
		tbl_extra_arte.ajax.reload();
		tbl_extra_animacion.ajax.reload();
		// console.log(data);
	});
}

function cargarTablaArte() {
	let id_especialidad = 1;
	tbl_arte = $('#tbl_arte').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"searching": true,
		dom: '',
		buttons: [
		'excelHtml5',
		],
		"ajax":{
			url:'../../controller/proyecto.php?op=cargarTablaProyectoEspecialidad',
			data:{
				id_proyecto:id_proyecto,
				id_especialidad:id_especialidad,
			},
			type: "post",
			dataType: "json",
			error: function(e){
				// console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"desc"]]
	}).DataTable(); 
}

function cargarTablaAnimacion() {
	let id_especialidad = 2;
	tbl_animacion = $('#tbl_animacion').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"searching": true,
		dom: '',
		buttons: [
		'excelHtml5',
		],
		"ajax":{
			url:'../../controller/proyecto.php?op=cargarTablaProyectoEspecialidad',
			data:{
				id_proyecto:id_proyecto,
				id_especialidad:id_especialidad,
			},
			type: "post",
			dataType: "json",
			error: function(e){
				// console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"desc"]]
	}).DataTable(); 
}

function cargarTablaExtraSonido() {
	let id_especialidad = 3;
	tbl_sonido = $('#tbl_sonido').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"searching": true,
		dom: '',
		buttons: [
		'excelHtml5',
		],
		"ajax":{
			url:'../../controller/proyecto.php?op=cargarTablaProyectoEspecialidad',
			data:{
				id_proyecto:id_proyecto,
				id_especialidad:id_especialidad,
			},
			type: "post",
			dataType: "json",
			error: function(e){
				// console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"asc"]]
	}).DataTable(); 
}


// ===================================
function cargarTablaExtraArte() {
	let id_perfil = 8;
	let id_especialidad = 5;
	tbl_extra_arte = $('#tbl_extra_arte').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"searching": true,
		dom: '',
		buttons: [
		'excelHtml5',
		],
		"ajax":{
			url:'../../controller/proyecto.php?op=cargarTablaProyectoPerfil',
			data:{
				id_proyecto:id_proyecto,
				id_perfil:id_perfil,
				id_especialidad:id_especialidad
			},
			type: "post",
			dataType: "json",
			error: function(e){
				// console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"desc"]]
	}).DataTable(); 
}

// ======================================
function cargarTablaExtraAnimacion() {
	let id_perfil = 9;
	let id_especialidad = 6;
	tbl_extra_animacion = $('#tbl_extra_animacion').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		"searching": true,
		dom: '',
		buttons: [
		'excelHtml5',
		],
		"ajax":{
			url:'../../controller/proyecto.php?op=cargarTablaProyectoPerfil',
			data:{
				id_proyecto:id_proyecto,
				id_perfil:id_perfil,
				id_especialidad:id_especialidad
			},
			type: "post",
			dataType: "json",
			error: function(e){
				// console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20,
		"order":[[0,"desc"]]
	}).DataTable(); 
}

// ======================================

function eliminarUsuarioProyecto(id_usuario_proyecto) {
	$.post("../../controller/proyecto.php?op=eliminarUsuarioProyecto",{
		id_usuario_proyecto:id_usuario_proyecto,
	}, function(data){
		tbl_arte.ajax.reload();
		tbl_animacion.ajax.reload();
		tbl_sonido.ajax.reload();
		data = JSON.parse(data);

	});
}

function modalAgregarPorcentaje(id_usuario_proyecto, id_especialidad,id_perfil,id_usuario,es_direccion) {
	$('#contenedor_mensaje_error').hide();
	$('#id_perfil').val(id_perfil);
	$('#id_usuario_proyecto').val(id_usuario_proyecto);
	$('#id_especialidad').val(id_especialidad);
	$('#id_usuario').val(id_usuario);
	$('#es_direccion').val(es_direccion);
	$('#editar-porcentaje').modal('show');
}


function editarPorcentaje() {
	let id_perfil = $('#id_perfil').val();
	let id_usuario_proyecto = $('#id_usuario_proyecto').val();
	let id_especialidad = $('#id_especialidad').val();

	let es_direccion = $('#es_direccion').val();

	let porcentaje = $('#nuevo_porcentaje').val();
	let valor_a_calcular;
	let valor_ganado;
	if (id_perfil == 2 || id_perfil == 3 ||id_perfil == 1) {
		valor_a_calcular = $('#valor_adminstrativo').val();
	}else{
		switch(id_especialidad){
			case '1':
			valor_a_calcular = $('#total_valor_arte').val();
			break;
			case '2':
			valor_a_calcular = $('#total_valor_animacion').val();
			break;
			case '3':
			valor_a_calcular = $('#valor_extra_sonido_final').val();
			break;
			case '5':
			valor_a_calcular = $('#valor_extra_arte_final').val();
			break;
			case '6':
			valor_a_calcular = $('#valor_extra_animacion_final').val();
			break;
		}
	}
	valor_ganado = (parseFloat(valor_a_calcular)*parseFloat(porcentaje))/100;
	$.post("../../controller/proyecto.php?op=editarPorcentaje",{
		id_proyecto:id_proyecto,
		id_perfil:id_perfil,
		id_usuario_proyecto:id_usuario_proyecto,
		porcentaje:porcentaje,
		es_direccion:es_direccion,
		valor_ganado:valor_ganado
	}, function(data){
		data = JSON.parse(data);
		if (data.estado == 0) {
			$('#mensaje_error').html(data.mensaje);
			$('#contenedor_mensaje_error').show(500);
		}else{
			tbl_arte.ajax.reload();
			tbl_animacion.ajax.reload();
			tbl_sonido.ajax.reload();
			tbl_extra_arte.ajax.reload();
			tbl_extra_animacion.ajax.reload();
			$('#nuevo_porcentaje').val('');
			$('#contenedor_mensaje_error').hide();
			$('#editar-porcentaje').modal('hide');
		}
	});
}

function agregarValorAdministrativoForja() {
	let id_perfil = 1;
	let id_usuario_proyecto = id_usuario_proyecto_forja;
	let porcentaje = $('#porcentaje_admin_forja').val();
	let valor_adminstrativo = $('#valor_adminstrativo').val();
	let valor_ganado = (parseFloat(valor_adminstrativo)*parseFloat(porcentaje))/100;
	// console.log(id_proyecto);
	// console.log(id_perfil);
	// console.log(id_usuario_proyecto);
	// console.log(porcentaje);
	// console.log(valor_adminstrativo);
	// console.log(valor_ganado);


	$.post("../../controller/proyecto.php?op=editarPorcentaje",{
		id_proyecto:id_proyecto,
		id_perfil:id_perfil,
		id_usuario_proyecto:id_usuario_proyecto,
		porcentaje:porcentaje,
		valor_ganado:valor_ganado
	}, function(data){
		data = JSON.parse(data);
		if (data.estado == 0) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Something went wrong!',
				footer: '<a href="">Why do I have this issue?</a>'
			});
			// console.log(data);
		}else{
			Swal.fire({
				icon: 'success',
				title: 'Bien',
				text: 'Valor agregado',
				footer: '<a href="">Why do I have this issue?</a>'
			});
			// console.log(data);
		}
	});

}


function distribucionPorcentajeAdministrativo() {
	let porcentaje_forja = 0;
	let porcentaje_arte = 0;
	let porcentaje_animacion = 0;
	$.post("../../controller/proyecto.php?op=distribucionPorcentajeAdministrativo",{
		id_proyecto:id_proyecto,
	}, function(data){
		data = JSON.parse(data);
		if (data.porcentaje_forja) {
			porcentaje_forja = parseInt(data.porcentaje_forja);
		}
		if (data.porcentaje_arte) {
			porcentaje_arte = parseInt(data.porcentaje_arte);
		}
		if (data.porcentaje_animacion) {
			porcentaje_animacion = parseInt(data.porcentaje_animacion);
		}
		$('#porcentajes-administrativos').modal('show');
		$('#lbl_ttl_porcentaje_asignado').html((porcentaje_forja+porcentaje_arte+porcentaje_animacion)+' %');
		$('#lbl_ttl_porcentaje_forja').html(porcentaje_forja+' %');
		$('#lbl_ttl_porcentaje_arte').html(porcentaje_arte+' %');
		$('#lbl_ttl_porcentaje_animacion').html(porcentaje_animacion+' %');
		// console.log(data);
	});
}

function modal_datos_del_proyecto() {
	$('#datos-del-proyecto').modal('show');
}
init();








