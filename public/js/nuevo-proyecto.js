function init() {
	// totalesRetiro();
	$('#lbl_check_obligatorio').hide();

	$("#frm_nuevo_proyecto").on("submit",function(e){
		nuevoProyecto(e);
	})

	// $.post("../../controller/porcentajes-operativos.php?op=cargarNivelArteAnimacion", function(r){
	// 	$("#nivel_arte_animacion").html(r);
	// 	$("#nivel_arte_animacion").selectpicker('refresh');
	// });

	$.post("../../controller/nivel-proyecto.php?op=cargarSelectNivelesProyecto", function(r){
		$("#nivelProyecto").html(r);
		$("#nivelProyecto").selectpicker('refresh');
	});


	$.post("../../controller/divisa.php?op=cargarSelectDivisa", function(r){
		$("#id_moneda").html(r);
		$("#id_moneda").selectpicker('refresh');
	});

	$.post("../../controller/gestionar-cliente.php?op=cargarSelectCliente", function(r){
		$("#id_cliente").html(r);
		$("#id_cliente").selectpicker('refresh');
	});


	$("#nivelProyecto").change(function(){
		nivelProyecto = $( this ).val();
		if (nivelProyecto != null) {
			nivelPorID(nivelProyecto);
		}
	}).change();
}

function nivelPorID(id) {
	$.post("../../controller/nivel-proyecto.php?op=nivelPorID",
		{id:id},
		function(data){
			data = JSON.parse(data);
			$('#valor_proyecto').val(data.valor_nivel);
		});
}

// function totalesRetiro() {
// 	$.post('../../controller/gestionar-cambios.php?op=totalesRetiro', function (data) {
// 		data = JSON.parse(data);
// 		$('#lbl_cantidad_usd').html('$ '+number_format(data.cantidad_usd,0));
// 		$('#lbl_cambio_cop').html('$ '+number_format(data.cambio_cop,0));
// 		$('#lbl_tasa').html('$ '+number_format(data.tasa,3));
// 		$('#cantidad_usd').val(data.cantidad_usd);
// 		$('#valor_avance_tasa').val(data.tasa);
// 	});
// }

function nuevoProyecto(e) {
	e.preventDefault();
	var formData = new FormData($("#frm_nuevo_proyecto")[0]);


	if ($('#check_arte').prop('checked') || $('#check_animacion').prop('checked')) {
		
		$.ajax({
			url: "../../controller/nuevo-proyecto.php?op=nuevoProyecto",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(data){
				data = JSON.parse(data);
				console.log(data);
				Swal.fire({
					icon: data.icon,
					title: data.title,
					text:data.text,
				}).then((result) => {
					// location.reload();
					window.location.href = '../gestionar-proyectos';
				});
			}
		});





	}else{
		$('#check_arte').focus();
		$('#lbl_check_obligatorio').show(800);
	}

}




init();