<?php 
session_start();
if(!isset($_SESSION['accid'])){
    header("Location: login.php");
	exit;
}
	$acc_id=$_SESSION['accid'];
		$conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
		if(!$conn){
			echo "<script type='text/javascript'>alert('RELOADING DUE TO DATABASE CONNECTIVITY ERROR')</script>";
		}else{
			$sql = "select * from pets where acc_id=$acc_id";
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
	 				<pre class="card-text"><?php echo "NAME : {$pet['pet_name']} TYPE : {$pet['pet_type']}\nBREED : {$pet['breed']}\nAGE : {$pet['age']} years WEIGHT : {$pet['weight']}{$pet['units']}\nGENDER : {$pet['gender']}\nPOSTED ON : <span class='pet_date_raw'>{$pet['posted_on']}</span>\nUPDATED ON : <span class='pet_date_raw'>{$pet['updated_on']}</span> " ?></pre>
	 				<button class="pet_edit_btn rounded-circle" value='<?php echo "{$pet['pet_id']}" ?>'><i class="far fa-edit"></i></button>
	 				<button class="pet_del_btn rounded-circle ml-1" value='<?php echo "-{$pet['pet_id']}" ?>'><i class="far fa-trash-alt"></i></button>
	 			</div>
	 	</div>
<?php } ?>