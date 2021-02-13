<?php 
session_start();
if(!isset($_SESSION['accid'])){
    header("Location: login.php");
	exit;
}
$acc_id = $_SESSION['accid'];
$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
if(!$conn){
	echo "<script type='text/javascript'>alert('RELOAD: DATABASE CONNECTIVITY ERROR')</script>";
}else{
	$sql = "select * from account_info natural join account_type where acc_id=$acc_id";

	$result = mysqli_query($conn,$sql);
	$acc_var = mysqli_fetch_all($result,MYSQLI_ASSOC)[0];
	mysqli_free_result($result);
	mysqli_close($conn);
}
?>

<div class="row">
<div class="col">
	<button class="edit_acc_btn rounded-circle m-1"><i class="far fa-edit"></i></button>
	<p style="font-weight: 600;" >account settings</p>
	<p style="color:white;text-shadow: 0 0 10px white">If email is already used updating to that email will not work</p>
	<table>
		<tr><td><label class="m-2" >NAME : <?=$acc_var['orgname']?></label></td></tr>
		<tr><td><label class="m-2">TYPE : <?=$acc_var['description']?></label></td></tr>
		<tr><td><label class="m-2">ADDRESS : <?=$acc_var['address']?></label></td></tr>
		<tr><td><label class="m-2" >EMAIL : <?=$acc_var['email']?></label></td></tr>
		<tr><td><label class="m-2" >PHONE : <?=$acc_var['phone']?></label></td></tr>
		<tr><td><label class="m-2" >PASSWORD : <?=$acc_var['pass_word']?></label></td></tr>
		<tr><td><label class="m-2" >COUNTRY : <?=$acc_var['country']?></label></td></tr>
		<tr><td><label class="m-2" >REGION : <?=$acc_var['region']?></label></td></tr>
		<tr><td><label class="m-2" >CITY : <?=$acc_var['city']?></label></td></tr>
	</table>
		
</div>	
</div>
