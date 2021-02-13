$("#pets_info").load("pets_info.php?accid="+acc_id);
$( "#dialog" ).dialog({
    autoOpen: false,
    position: {
      my: "center",
      at: "right",
      of: window
    },
    show:{effect:"blind",duration:800},
    dialogClass: "no-close",
    buttons: [
        {
            icon:"fas fa-paw",
            text: "Ok",
            click: function() {
                $('.ui-dialog').effect("blind",800);
                $( this ).dialog( "close");
                $("#dialog").ajaxSubmit({success:function(){$("#pets_info").load("pets_info.php");}});
                document.querySelector("#dialog").reset();
            }
        },
        {
            icon:"fas fa-paw",
            text: "Cancel",
            click: function() {
                $('.ui-dialog').effect("blind",800);
                $( this ).dialog( "close" );
            }
        }
    ]
});
	$("#add_pet").click(function(){$("#dmsg").css({display:"none"});$("#posted_on").val("0"); $("#dialog").dialog("open");});
	$("#pets_info").on("click",".pet_edit_btn",function () {
		$("#dmsg").css({display:"block"});$("#posted_on").val($(this).val()); $("#dialog").dialog("open");
	});
	$("#pets_info").on("click",".pet_del_btn",function () {
		$("#posted_on").val($(this).val());
			$.ajax("account.php",{
				type: 'POST',
	  			data: {
	    			posted_on:$(this).val()
	  			},
	  			success: function() {
	    			$("#pets_info").load("pets_info.php");
	  			}
		});
	});




$("#ok_acc_button").on("click",function(){
    $("#acc_set_form").ajaxSubmit({success:function(){$("#pets_info").load("accountsettings.php");}});
    document.querySelector("#acc_set_form").reset();
});

$("#account_nav").on("click",function(){
    $("#pets_info").load("accountsettings.php?accid="+acc_id);
});

$("#pets_nav").on("click",function(){
    $("#pets_info").load("pets_info.php?accid="+acc_id);
});

$("#logout_nav").on("click",function(){
    $("#logout_form").submit();
});