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

function adminLogin() {
    var x;
    if(x = window.prompt('Syötä salasana:')){
        document.querySelector("#password").value = x;
        document.forms[0].submit();
    }
}
