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
	
	$("#adminloginbutton").click(function(ev){
		ev.preventDefault();
		adminLogin();
	});
	$("#adminlogoutbutton").click(function(ev){
		ev.preventDefault();
		adminLogout();
	});
});

function adminLogin() {
    var x;
    if(x = window.prompt('Syötä salasana:')){
        $("#password").val(x);
        $("#adminlogin").submit();
    }
}

function adminLogout() {
        $("#adminlogout").submit();
}