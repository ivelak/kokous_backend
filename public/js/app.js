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
        
        $("#radio2").change(function () {
        if (!$("#radio2").attr("checked")) {
            $('#radio1').attr("checked", false);
            $('#field1').removeAttr('disabled');
            $('#field2').removeAttr('disabled');
            $('#date').attr('disabled', 'yes');
        }
    });
    
    $("#radio1").change(function () {
        if (!$("#radio1").attr("checked")) {
            $('#radio1').attr("checked", true);
            $('#radio2').attr("checked", false);
            $('#field1').attr('disabled', 'yes');
            $('#field2').attr('disabled', 'yes');
            $('#date').removeAttr('disabled');
        }
    });
    
    $("select.sieve").sieve({ itemSelector: "option" });
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

function selectAllFromTaskGroup(id, pID)
    {
        if($('#' + id).is(':checked'))
        {
            $('#'+pID + " :checkbox").prop('checked', true);
        }
        else
        {
            $('#'+pID + " :checkbox").prop('checked', false);
        }
    }
    
function addActivitiesToList()
    {
        $('#selector option:selected').each(function () {
            $(this).removeAttr("selected");
            $(this).attr('disabled', true);
            $('<li class="list-group-item" id=' + $(this).val() + '><input hidden name="selected_activity[]" value="'+$(this).val()+'"/>'+ $(this).html() +'<span class="pull-right"><button class="btn btn-xs btn-warning" onclick="removeActivity(' + $(this).val() +')" type="button"><span class="glyphicon glyphicon-trash"></span></button></span></li>').appendTo('#activityList');
        });
    }
    
    function removeActivity(activity) {
        var elem = $("[value=" + activity + "]");
        elem.removeAttr("disabled selected");
        console.log("li #"+ activity);
        $("#"+ activity).remove();
    }
