<?php session_start();

if(isset($_SESSION['token']) && isset($_POST['phone']) && $_POST['phone'] != ""){
	
	$secure = $_SESSION['token'];include '../includes/c.php';
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if($select && mysqli_num_rows($select) == 1){
		
		$phone = $_POST['phone'];
		$change = mysqli_query($con,"UPDATE users SET phone='$phone' WHERE secure='$secure'");
		
		if(!$change){
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}else{
			
			echo 'success';
		}
	}else{
		echo "Vabandust, kuid midagi läks valesti.";
	}
}else{
	echo "Palun sisestage korrektne telefoninumber!";
}

?>