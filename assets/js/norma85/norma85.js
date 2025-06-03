$(document).ready(function() {
    $('#normaSelect').change(function() {
        const norma = $(this).val();
        if (norma) {
            $.post('NormaController/get_formulario', { norma }, function(data) {
                $('#formularioNorma').html(data);
            });
        } else {
            $('#formularioNorma').empty();
        }
    });

    $(document).on('submit', '#formNorma', function(e) {
        e.preventDefault();
        const datos = $(this).serialize();
        $.post('NormaController/guardar_dato', datos, function(res) {
            alert('Dato guardado');
            cargarTabla();
        });
    });

    function cargarTabla() {
        $.get('NormaController/obtener_tabla', function(html) {
            $('#tablaNorma').html(html);
        });
    }

    cargarTabla(); // inicial
});
