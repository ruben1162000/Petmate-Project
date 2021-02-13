<?php 
session_start();
if(!isset($_SESSION['accid'])){
    header("Location: login.php");
	exit;
}
$acc_id = $_SESSION['accid'];
function compress_png($source,$min_quality=60,$max_quality = 75)
{
    $compressed_png_content = shell_exec("D:\\app_programs\\pngquant\\pngquant --quality=$min_quality-$max_quality - < ".$source." > D:\\wamp64\\www\\test\\uploads\\temporary.png");
    return base64_encode(file_get_contents("D:/wamp64/www/test/uploads/temporary.png"));
}
function compress_jpeg($source,$quality=75)
{
    $compressed_jpeg_content = shell_exec("D:\\app_programs\\mozjpeg\\cjpeg -quality $quality ".$source." > D:\\wamp64\\www\\test\\uploads\\temporary.jpg");
    return base64_encode(file_get_contents("D:/wamp64/www/test/uploads/temporary.jpg"));
}
print_r($_POST);
echo "<script type='text/javascript'>console.log('{$_POST['posted_on']}')</script>\n";
// if(isset($_POST["posted_on"])){
	if($_POST["posted_on"]==0){
		echo "<script type='text/javascript'>alert('you are inserting a pet')</script>\n";
		$var=$_FILES['pet_pic'];
		$pet_name = null; 
		$pet_type = null; 
		$breed = null; 
		$age = null;  
		$weight = null; 
		$units = null; 
		$gender = null; 
		$mime_type = null;  
		$pet_pic = null;  
		if($var["size"]>20 *1024 * 1024){
			echo "<script type='text/javascript'>alert('Image file size greater than 20MB')</script>";
		}else{
			$mime_type=$var["type"];
			if($mime_type=="image/jpeg"){
				$pet_pic=compress_jpeg($var["tmp_name"],40);
			}else{
				$pet_pic=compress_png($var["tmp_name"],40,40);
			}

			$pet_name=$_POST["pet_name"];
			$pet_type=$_POST["pet_type"]; 
			$breed=$_POST["breed"]; 
			$age=$_POST["age"];  
			$weight=$_POST["weight"]; 
			$units=$_POST["units"]; 
			$gender=$_POST["gender"];

			$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");

			if(!$conn){
				echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
			}else{
				$sql = "INSERT INTO `pets` VALUES (NULL,'$pet_name','$pet_type','$breed',$age,$weight,'$units','$gender','$mime_type','$pet_pic',DEFAULT,DEFAULT,$acc_id)";
				$result = mysqli_query($conn,$sql);
				// echo "<script type='text/javascript'>console.log(\"$sql\")</script>";
				mysqli_close($conn);
				if(!$result){
					echo "<script type='text/javascript'>alert('PET COULD NOT BE ADDED PLEASE TRY AGAIN!!')</script>";
				}
			}

		}
	}

	else if($_POST["posted_on"]>0){
		$pet_id = $_POST["posted_on"];
		$var=$_FILES['pet_pic'];
		if($var["size"]>20 *1024 * 1024){
			echo "<script type='text/javascript'>alert('Image file size greater than 20MB')</script>";
			exit;
		}
		$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
		if(!$conn){
			echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
			exit;
		}
		if($var["size"]!=0){
			$mime_type=$var["type"];
			if($mime_type=="image/jpeg"){
				$pet_pic=compress_jpeg($var["tmp_name"],40);
			}else{
				$pet_pic=compress_png($var["tmp_name"],40,40);
			}

			$sql="UPDATE pets SET mime_type = '$mime_type', pet_pic='$pet_pic' WHERE pet_id = $pet_id AND acc_id=$acc_id";
			echo "<script type='text/javascript'>console.log(\"$sql\")</script>";
			$result = mysqli_query($conn,$sql);
			if(!$result){
				echo "<script type='text/javascript'>alert('PET'S PIC COULD NOT BE EDITED PLS TRY AGAIN!!')</script>";
				mysqli_close($conn);
				exit;
			}
		}

		$change = ["pet_name"=>$_POST["pet_name"],"pet_type"=>$_POST["pet_type"],"breed"=>$_POST["breed"],"age"=>$_POST["age"],"weight"=>$_POST["weight"],"units"=>$_POST["units"],"gender"=>$_POST["gender"],"updated_on"=>"DEFAULT"];
		foreach ($change as $key => $value) {
			if(!empty($value)){
				if($key=="age" || $key=="weight" || $key=="updated_on") $sql="UPDATE pets SET $key=$value WHERE pet_id = $pet_id AND acc_id=$acc_id";
				else $sql="UPDATE pets SET $key='$value' WHERE pet_id = $pet_id AND acc_id=$acc_id";
				$result = mysqli_query($conn,$sql);
				if(!$result){
					mysqli_close($conn);
					$up = strtoupper($key);
					echo "<script type='text/javascript'>alert('$up COULD NOT BE EDITED PLS TRY AGAIN!!')</script>";
					exit;
				}
			}
		}
		mysqli_close($conn);

	}

	else if($_POST["posted_on"]<0){
		$pet_id = -1*$_POST["posted_on"];
		$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
		if(!$conn){
			echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
			exit;
		}
		$sql="DELETE FROM pets WHERE pet_id = $pet_id AND acc_id=$acc_id";
		echo "<script type='text/javascript'>console.log(\"$sql\")</script>";
		$result = mysqli_query($conn,$sql);
		mysqli_close($conn);
		if(!$result){
			echo "<script type='text/javascript'>alert('PET#$pet_id COULD NOT BE DELETED PLEASE TRY AGAIN!!')</script>";
			exit;
		}
	}
 

// }

?>