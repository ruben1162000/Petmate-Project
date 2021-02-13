<?php 
session_start();
if(!isset($_SESSION['accid'])){
    header("Location: login.php");
	exit;
}
$acc_id=$_SESSION['accid'];
$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
$orgname=null;
if(!$conn){
	echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
}else{
	$sql = "select orgname from account_info where acc_id=$acc_id";
	$result = mysqli_query($conn,$sql);
	$info = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$orgname = $info[0]['orgname']; 
	mysqli_close($conn);
}
 ?>

<!-- <div id=acc_logo class="card=body rounded-circle mb-0">
</div> -->
<!-- <div class="card-header text-center mt-0 rounded" id="acc_name">
 </div> -->
  <?php echo "$orgname"; ?>