<?php if(isset($_GET['email']) && $_GET['email'] != "" && filter_var(urldecode($_GET['email']),FILTER_VALIDATE_EMAIL)){
	
	include '../includes/c.php';
	$email = urldecode($_GET['email']);
	$check = mysqli_query($con,"SELECT * FROM subscribers WHERE email='$email'");
	
	if(mysqli_num_rows($check) == 0){
		$set = mysqli_query($con,"INSERT INTO subscribers VALUES ('$email')");
		
		if($set){
			echo "success";
		}else{
			echo mysqli_error($con);
		}
	}else{
		echo "Selline meiliaadress juba on meie nimekirjas!";
	}
}
?>