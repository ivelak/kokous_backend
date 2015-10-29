$(document).ready(function () {
    $("tr.tr-link").on({
        mouseenter: function () {
            $(this).css('cursor', 'pointer');
        },
        mouseleave: function () {
            $(this).css('cursor', 'auto');
        },
        click: function () {
            document.location.href = $(this).data('target');
        }
    });
});
