<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
    exit;
}
		$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
		if(!$conn){
			echo "<script type='text/javascript'>alert('RELOADING DUE TO DATABASE CONNECTIVITY ERROR')</script>";
		}else{
			$sql = "select * from pets natural join account_info natural join account_type";
			echo "<script type='text/javascript'>console.log('$sql')</script>";
			$result = mysqli_query($conn,$sql);
			$pets = mysqli_fetch_all($result,MYSQLI_ASSOC);
			mysqli_free_result($result);
			mysqli_close($conn);
		}
?>

	 <?php foreach ($pets as $key => $pet) { ?>
	 	<div class = 'row mb-3' id='<?php echo "pet".$pet["pet_id"] ?>'>
	 			<div class="col-6 p-2">
	 				<img src='<?php echo "data:{$pet['mime_type']};base64,{$pet['pet_pic']}" ?>'>
	 			</div>
	 			<div class="card-body col-6">
	 				<h5 class="card-title"><?php echo "petid#".$pet["pet_id"]; ?></h5>
	 				<p class="card-text">
						NAME : <?=$pet['pet_name']?><br>
						TYPE : <?=$pet['pet_type']?><br>
						BREED : <?=$pet['breed']?><br>
						AGE : <?=$pet['age']?><br>
						WEIGHT : <?=$pet['weight']?> <?=$pet['units']?><br>
						GENDER : <?=$pet['gender']?><br>
						POSTED ON : <?=$pet['posted_on']?><br>
						UPDATED ON : <?=$pet['updated_on']?><br>
						ACCOUNT: <?=$pet["orgname"]?><br>
						ACCOUNT TYPE : <?=$pet["description"]?><br>
						EMAIL : <?=$pet["email"]?><br>
						PHONE : <?=$pet["phone"]?><br>
	 				</p>
	 			</div>
	 	</div>
<?php } ?>