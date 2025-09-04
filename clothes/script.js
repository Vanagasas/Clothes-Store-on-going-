$(document).ready(function() {
    $('.register-form').hide();
    $('#no-acc').click(function() {
        $('.login-form').fadeOut(200, function() {
            $('.register-form').fadeIn(200);
        });
    });
    $('#yes-acc').click(function() {
        $('.register-form').fadeOut(200, function() {
            $('.login-form').fadeIn(200);
        });
    });
});