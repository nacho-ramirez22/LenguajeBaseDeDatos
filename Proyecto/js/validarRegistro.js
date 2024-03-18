$(document).ready(function() {
    $('#formRegistro').submit(function(e) {
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var telefono = $('#telefono').val();
        var username = $('#Username').val();
        var password = $('#Password').val();

        if (username === '' || password === '') {
            e.preventDefault();
            alert('Todos los campos deben ser completados.');
        }
    });
});