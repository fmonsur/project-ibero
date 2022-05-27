function init() {
    $('#acept_terminos').hide();
    $("#frm_registro").on("submit",function(e){
        guardar(e);
    })

}

function guardar(e){
    e.preventDefault();
    var formData = new FormData($("#nuevoLead")[0]);

    // if( $('#terminos').is(':checked')){
    //     alert('Seleccionado');
    // }else{
    //     $('#acept_terminos').show(500);

    // }
    // alert('Hola mama');

    Swal.fire({
        icon: 'success',
        title: 'Bien !!!',
        text: 'El registro ha sido exitoso',
    }).then((result) => {
        window.location.href = "../../";
    })
}



init();


// $(document).ready(function() {
//     $("#show_hide_password a").on('click', function(event) {
//         event.preventDefault();
//         if($('#show_hide_password input').attr("type") == "text"){
//             $('#show_hide_password input').attr('type', 'password');
//             $('#show_hide_password i').addClass( "fa-eye-slash" );
//             $('#show_hide_password i').removeClass( "fa-eye" );
//         }else if($('#show_hide_password input').attr("type") == "password"){
//             $('#show_hide_password input').attr('type', 'text');
//             $('#show_hide_password i').removeClass( "fa-eye-slash" );
//             $('#show_hide_password i').addClass( "fa-eye" );
//         }
//     });
// });