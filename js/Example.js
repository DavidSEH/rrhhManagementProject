$(document).ready(function(){
    if ($('#btnEnviar').length) {
        $('#btnEnviar').click(function(){
            const telefono=$('#telefono').val();
            

            $('#telefono2').html(telefono);
            
        })
    }
});