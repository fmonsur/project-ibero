function init(){

	$('#box_code').hide();
	$('#box_recuperacion').hide();
}


function verInputCode() {
	ocultarBox();
	// $('#box_login').hide(500);
	$('#box_code').show(500);
}

function verInputRecuperacion() {
	// $('#box_login').hide(500);
	ocultarBox();
	$('#box_recuperacion').show(500);
}

function verFormLogin() {
	ocultarBox();
	// $('#box_code').hide(500);
	$('#box_login').show(500);
	
}

function ocultarBox(){
	$('#box_recuperacion').hide(500);
	$('#box_login').hide(500);
	$('#box_code').hide(500);

}

function verFormRegistro(){
	window.location.href = "v1/registro";
}

function recuperarContrasena() {
	Swal.fire({
        icon: 'success',
        title: 'Revisa tu correo !!!',
        text: 'Hemos enviado un enlace de recuperación',
    }).then((result) => {
        verFormLogin();
    })
}

function ingresar(){
	window.location.href = "v1/";
}

init();