<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
    exit;
}
$user_id=$_SESSION['userid']; 
$change = ["fname"=>$_POST["fname"],"lname"=>$_POST["lname"],"pass_word"=>$_POST["password"],"email"=>$_POST["email"] ];
echo "<script type='text/javascript'>console.log('entered the account update')</script>";
$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
if(!$conn){
	echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
	exit;
}
foreach ($change as $key => $value) {
		if(!empty($value)){
			$sql="UPDATE petmate_users SET $key='$value' WHERE user_id = $user_id";
			echo "<script type='text/javascript'>console.log(\"$sql\")</script>";
			$result = mysqli_query($conn,$sql);
			if(!$result){
				echo "<script type='text/javascript'>alert('EMAIL ALREADY USED')</script>";
			}
		}
	}
mysqli_close($conn);
	

 ?>