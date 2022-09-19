$(document).ready(function () {
    $.get($('#box-gold').data('url'), function (data) {
        $('#box-gold').html(data);
    }, 'html');

    $.get($('#box-coin').data('url'), function (data) {
        $('#box-coin').html(data);
    }, 'html');
});
