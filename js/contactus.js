var radio = document.querySelectorAll('.radiostyle');
// var radlabel = document.querySelectorAll('#type label');
var radioIn = document.querySelectorAll('input[type=checkbox]');
// since pet shop is checked initially
var dia = document.getElementById("dialog");
var yourMailMsg = "";

function validateYourMail(){
    let givenMail = $('#yourmail').val().trim();
    $('#yourmail').val(givenMail);
    if(!givenMail){
        yourMailMsg = "Please enter your mail...";
        return false;
    }
    else if(!isEmail(givenMail)){
        yourMailMsg = "Please enter a valid mail...";
        return false;
    }else{
        yourMailMsg="";
        return true;
    }  
}

function isEmail(email){
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

radio[0].classList.add('fas','fa-paw','pawstyle');
radio[0].addEventListener('click',function(event){ 
    if(radioIn[0].checked)
        radio[0].classList.add('fas','fa-paw','pawstyle');
    else
        radio[0].classList.remove('fas','fa-paw','pawstyle');
});
radio[1].addEventListener('click',function(event){
    if(radioIn[1].checked)
        radio[1].classList.add('fas','fa-paw','pawstyle');
    else
        radio[1].classList.remove('fas','fa-paw','pawstyle');
});

$( "#dialog" ).dialog({
    autoOpen: false,
    position: {
      my: "center",
      at: "right",
      of: window
    },
    show:{effect:"bounce",duration:800},
    dialogClass: "no-close",
    buttons: [
        {
            icon:"fas fa-paw",
            text: "Ok",
            click: function() {
                $('.ui-dialog').effect("blind",800);
                $( this ).dialog( "close" );
            }
        }
    ]
});

$( "#opener" ).click(function() {
    if(!validateYourMail()){
        dia.innerHTML=yourMailMsg+"<i style='color:yellow' class='fas fa-grin-beam-sweat'></i>";
        $("#dialog").dialog("open");
    }
    else if(!$('#feedbody').val()){
        dia.innerHTML="Feedback is empty <i style='color:yellow' class='fas fa-grin-beam-sweat'></i>";
        $("#dialog").dialog("open");
    }
    else if(!radioIn[0].checked && !radioIn[1].checked){
        dia.innerHTML = "Select a mail!!<i style='color:yellow' class='fas fa-tired'></i>";
        $("#dialog").dialog("open");

    }
    else{
        dia.innerHTML="Send feedback <i style='color:yellow' class='fas fa-grin-beam'></i>"
        $("#dialog").dialog({
            show:{effect:"blind",duration:800},
            buttons: [
                {
                    icon:"fas fa-paw",
                    text: "Ok",
                    click: function() {
                        $('.ui-dialog').effect("blind",800);
                        $( this ).dialog( "close" );
                        document.forms["feedback-form"].submit();
                    }
                },
                {
                    icon:"fas fa-paw",
                    text: "cancel",
                    click: function() {
                        $('.ui-dialog').effect("blind",800);
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });
        $("#dialog").dialog("open");                   
    }

});