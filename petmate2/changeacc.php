<?php 
session_start();
if(!isset($_SESSION['accid'])){
    header("Location: login.php");
	exit;
}
$acc_id = $_SESSION['accid'];
$change = ["orgname"=>$_POST["org_name"],"acc_type_id"=>$_POST["acc_type"],"address"=>$_POST["address"],"phone"=>$_POST["phone"],"pass_word"=>$_POST["password"],"email"=>$_POST["email"]];
echo "<script type='text/javascript'>console.log('entered the account update')</script>";
$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
if(!$conn){
	echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";;
	exit;
}
foreach ($change as $key => $value) {
		if(!empty($value)){
			if($key=="acc_type_id"){$sql="UPDATE account_info SET $key=$value WHERE acc_id = $acc_id";} 
			else {$sql="UPDATE account_info SET $key='$value' WHERE acc_id = $acc_id";}
			echo "<script type='text/javascript'>console.log(\"$sql\")</script>";
			$result = mysqli_query($conn,$sql);
			if(!$result){
				echo "<script type='text/javascript'>alert('EMAIL ALREADY USED');</script>";
			}
		}
	}
mysqli_close($conn);	
 ?>