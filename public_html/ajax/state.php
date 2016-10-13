<?php error_reporting(E_ALL); ini_set('display_errors', 1);session_start();
include '../includes/c.php';

if(isset($_SESSION['token']) && isset($_POST['state']) && $_POST['state'] != ""){
	
	$secure = $_SESSION['token'];
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if($select && mysqli_num_rows($select) == 1){
		
		$state = $_POST['state'];
		$change = mysqli_query($con,"UPDATE users SET state='$state' WHERE secure='$secure'");
		
		if(!$change){
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}else{
			
			echo 'success';
		}
	}else{
		echo "Vabandust, kuid midagi läks valesti.";
	}
}

?>