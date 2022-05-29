// $('#tbl_codigos').dataTable();
$('#tbl_codigos').dataTable({
	"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
	}
});

function makeid(length) {
	var result           = '';
	var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	var charactersLength = characters.length;
	for ( var i = 0; i < length; i++ ) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}

console.log(makeid(6));

function generarCodigo() {
	let codigo = makeid(6);
	$('#codigo').html(codigo);
}

function guardarCodigo() {
	Swal.fire({
		icon: 'success',
		title: 'Bien!!!',
		text: 'Código almacenado correctamente',
	});
}