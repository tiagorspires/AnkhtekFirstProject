$(document).ready(function() {
    $('#addtask').on('submit', function(event) {
        event.preventDefault();

        jQuery.ajax({
            url: "/tasks",
            data: jQuery(this).serialize(),
            type: 'POST',
            success: function(result) {
                alert(result.message);
                jQuery('#addtask')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Ocorreu um erro: ' + error);
            }
        });
    });
});


