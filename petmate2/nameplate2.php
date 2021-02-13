<?php 
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
    exit;
}
$user_id=$_SESSION['userid'];
$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
$orgname=null;
if(!$conn){
	echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
}else{
	$sql = "SELECT CONCAT(fname,' ',lname) AS username from petmate_users where user_id=$user_id";
	$result = mysqli_query($conn,$sql);
	$info = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$username = $info[0]['username']; 
	mysqli_close($conn);
}
 ?>

<!-- <div id=acc_logo class="card=body rounded-circle mb-0">
</div> -->
<!-- <div class="card-header text-center mt-0 rounded" id="acc_name">
 </div> -->
  <?php echo "$username"; ?>