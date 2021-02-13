<?php 
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
    exit;
}
$user_id=$_SESSION['userid'];
$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
if(!$conn){
	echo "<script type='text/javascript'>alert('RELOAD: DATABASE CONNECTIVITY ERROR')</script>";
}else{
	$sql = "select * from petmate_users where user_id=$user_id";

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
		<tr><td><label class="m-2" >FIRST NAME : <?=$acc_var['fname']?></label></td></tr>
		<tr><td><label class="m-2" >LAST NAME : <?=$acc_var['lname']?></label></td></tr>
		<tr><td><label class="m-2" >EMAIL : <?=$acc_var['email']?></label></td></tr>
		<tr><td><label class="m-2" >PASSWORD : <?=$acc_var['pass_word']?></label></td></tr>
	</table>
</div>	
</div>
