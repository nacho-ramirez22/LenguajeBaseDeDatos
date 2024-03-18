$(document).ready(function() {
    $('#formLogin').submit(function(e) {
        var username = $('#Username').val();
        var password = $('#Password').val();

        if (username === '' || password === '') {
            e.preventDefault();
            alert('Todos los campos deben ser completados.');
        }
    });
});