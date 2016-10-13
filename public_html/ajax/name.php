<?php session_start();

if(isset($_SESSION['token']) && isset($_POST['name']) && $_POST['name'] != "" && preg_match("/^[a-zA-Z '-]*$/",$_POST['name'])){
	
	$secure = $_SESSION['token'];include '../includes/c.php';
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if($select && mysqli_num_rows($select) == 1){
		
		$name = $_POST['name'];
		$change = mysqli_query($con,"UPDATE users SET fullname='$name' WHERE secure='$secure'");
		
		if(!$change){
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}else{
			
			echo 'success';
		}
	}else{
		echo "Vabandust, kuid midagi läks valesti.";
	}
}else{
	echo "bad data";
}

?>