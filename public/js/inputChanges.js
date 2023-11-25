$(document).ready(function(){
    $("input").click(function() {
        $(this).removeClass('is-invalid');
        $(this).parent().children('.under_error').html('');
    });
    $("textarea").click(function() {
        $(this).removeClass('is-invalid');
        $(this).parent().children('.under_error').html('');
    });
});
