<!-- data:[<media type>][;charset=<character set>][;base64],<data> -->
<?php 
	session_start();
	if(!isset($_SESSION['accid'])){
		header("Location: login.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<title>petmate</title>
	<link rel="stylesheet" type="text/css" href="/css/account.css">
</head>
<body class="bg-dark">
<span id=acc_nav_container class="m-0">
	<nav id="acc_nav" class="navbar navbar-dark bg-dark m-0">
		<h1 id=acc_head class="display-4 text-center bg-dark text-light"><i class="fas fa-paw"></i> PETMATE</h1>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#acc_nav_contents" aria-controls="acc_nav_contents" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
	</nav>
	<div id=acc_nav_contents class="collapse bg-dark m-0">
	    <ul class="m-0">
	      <li>
	        <a  href="#" id="account_nav">account</span></a>
	      </li>
	      <li>
	        <a href="#" id="pets_nav">pets</a>
	      </li>
	      <li>
	        <a  href="#" id="logout_nav" >log out</a>
	      </li>
	       <li>
	        <a  href="#" id="delete_acc_nav">DELETE ACCOUNT</a>
	      </li>
	    </ul>
	</div>
</span>


<div class="card border text-center display-4" id="acc_name">
</div>


<form style="display:none" id=dialog action="changepets.php" method="post" target="post_pets_frame" enctype="multipart/form-data">
	<p id=dmsg class="m-1" style="display:none">Only Fill The Ones To Be Updated</p>
	<table>
		<tr><td><label class="mx-1" for="pet_name">NAME</label></td> <td><input type="text" name="pet_name" id="pet_name" placeholder="Name if any"></td></tr>
		<tr><td><label class="mx-1" for="pet_type">TYPE</label></td> <td><input type="text" name="pet_type" id="pet_type" placeholder="bird,dog,cat etc no plurals"></td></tr>
		<tr><td><label class="mx-1" for="breed">BREED</label></td> <td><input type="text" name="breed" id="breed" placeholder="Breed required"></td></tr>
		<tr><td><label class="mx-1" for="age">AGE</label></td> <td><input type="text" name="age" id="age" placeholder="in years"></td></tr>
		<tr><td><label class="mx-1" for="weight">WEIGHT</label></td> <td><input type="text" name="weight" id="weight" placeholder="in kg/gm"> <label for=kg>kg</label> <input type="radio" name="units" id="kg" value="kg"> <label for=gm>gm</label> <input type="radio" name="units" id="gm" value="gm"></td></tr>
		<tr><td><label class="mx-1">GENDER</label></td> <td><label for="male">Male</label> <input type="radio" name="gender" id="male" value="male"> <label for="female">Female</label> <input type="radio" name="gender" id="female" value="female"></td></tr>
		<tr><td><label class="mx-1" for="pet_pic">PET'S PIC</label></td> <td><input type="file" name="pet_pic" accept=".png,.jpeg,.jpg" id="pet_pic"></td></tr>
	</table> 
	<input style="visibility: hidden;" type="text" name="posted_on" id="posted_on">
	<!-- <input style="visibility: hidden;" type="text" name="accid" id="pet_accid"> -->
	<br>
</form>

<form style="display: none" id="acc_set_form" action="changeacc.php" method="post" target="_blank">
	<p id=dmsg2>Only Fill The Ones To Be Updated</p>
	<table>
		<tr><td><label class="mx-1" for="org_name">NAME: </label></td> <td><input type="text" name="org_name" id="org_name"></td></tr>
		<tr><td><label class="mx-1">TYPE :</label></td><td><label for="pet_shop">pet shop</label> <input type="radio" name="acc_type" id="pet_shop" value="1"> <label for="animal_org">animal welfare org</label> <input type="radio" name="acc_type" id="animal_org" value="2"></td></tr>
		<tr><td><label class="mx-1" for="address">ADDRESS:</label></td> <td><input type="text" name="address" id="address"></td></tr>
		<tr><td><label class="mx-1" for="email">EMAIL:</label></td> <td><input type="email" name="email" id="email"></td></tr>
		<tr><td><label class="mx-1" for="phone">PHONE:</label></td> <td><input type="text" name="phone" id="phone"></td></tr>
		<tr><td><label class="mx-1" for="password">PASSWORD:</label></td> <td><input type="text" name="password" id="password"></td></tr>
	</table>
</form>
<button id="add_pet" name="add_pet" value="add_pet" class="my-3 mr-3 btn btn-light"><i class="fas fa-plus"></i> Add a Pet</button>
<a href="petsinfodownload.php" target="_blank"><button id="down_pets" name="down_pets" value="down_pets" class="my-3 btn btn-light"><i class="fas fa-arrow-down"></i> Download</button></a>

<div id="pets_info" class="container flex-row flex-wrap mt-3">
</div>

<iframe style="display: none" src="" name="post_pets_frame"></iframe>
<iframe style="display: none" src="" name="post_acc_frame"></iframe>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
$("#pets_info").load("pets_info.php");
$("#acc_name").load("nameplate.php");
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
                $(".ui-dialog[aria-labelledby=ui-id-1]").effect("blind",800);
                $( this ).dialog( "close");
                $("#dialog").ajaxSubmit({success:function(){
                	$("#pets_info").load("pets_info.php");
                	$("#dialog")[0].reset();
                }});
                
            }
        },
        {
            icon:"fas fa-paw",
            text: "Cancel",
            click: function() {
                $(".ui-dialog[aria-labelledby=ui-id-1]").effect("blind",800);
                $( this ).dialog( "close" );
            }
        }
    ]
});

$( "#acc_set_form" ).dialog({
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
                $('.ui-dialog[aria-labelledby=ui-id-2]').effect("blind",800);
                $( this ).dialog( "close");
                $("#acc_set_form").ajaxSubmit({success:function(){
			    	$("#pets_info").load("accountsettings.php");
			    	$("#acc_name").load("nameplate.php");
			    	$("#acc_set_form")[0].reset();
			    }});
            }
        },
        {
            icon:"fas fa-paw",
            text: "Cancel",
            click: function() {
                $('.ui-dialog[aria-labelledby=ui-id-2]').effect("blind",800);
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
			$.ajax("changepets.php",{
				type: 'POST',
	  			data: {
	    			posted_on:$(this).val()
	  			},
	  			success: function() {
	    			$("#pets_info").load("pets_info.php");
	  			}
		});
	});

	$("#pets_info").on("click",".edit_acc_btn",function () {
		 $("#acc_set_form").dialog("open");
	});


$("#account_nav").on("click",function(){
    $("#pets_info").load("accountsettings.php");
});

$("#pets_nav").on("click",function(){
    $("#pets_info").load("pets_info.php");
});

$("#logout_nav").on("click",function(){
	$.ajax("account.php",{
		type: 'POST',
  		data: {
    			logout:"yes"
  			},
  		success: function() {
  			window.location.href="login.php";
  		}
	});
});

$("#delete_acc_nav").on("click",function(){
	let con = confirm("ARE YOU SURE YOU WANT TO DELETE THIS ACCOUNT?");
	console.log('con = '+con);
	if(con){
    	$.ajax("account.php",{
			type: 'POST',
  			data: {
    			delyouracc:"yes"
  			},
  			success: function() {
  			window.location.href="login.php";
  		}
		});
    }
});
</script>
<?php 
if(isset($_POST["logout"])){
	session_destroy();
}
if(isset($_POST["delyouracc"])){ 
	$acc_id = $_SESSION['accid'];
	echo "<script type='text/javascript'>console.log('delete request acc_id=$acc_id');</script>\n";
	$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb"); 
	if(!$conn){
		echo "<script type='text/javascript'>alert('RELOAD:DATABASE CONNECTIVITY ERROR');</script>\n";
	}else{
		$sql = "DELETE FROM account_info where acc_id=$acc_id";
		echo "<script type='text/javascript'>console.log(\"$sql\");</script>";
		$result = mysqli_query($conn,$sql);
		mysqli_close($conn);
		if(!$result){
			echo "<script type='text/javascript'>alert('ERROR :COULD NOT DELETE ACCOUNT DUE TO DATABASE ISSUE');</script>";
		}else{
			echo "<script type='text/javascript'>alert('YOUR ACCOUNT WITH ID=$acc_id WAS DELETED');</script>\n";
			session_destroy();
		}
	}
}
?>
</body>

</html>
