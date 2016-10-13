<?php session_start();
include '../includes/c.php';

if(isset($_SESSION['token'])){
	
	$secure = $_SESSION['token'];
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if($select && mysqli_num_rows($select) == 1){
		
		$result = mysqli_fetch_array($select);
		$email = $result['email'];
		$uid = $result['id'];
		$delete = mysqli_query($con,"DELETE FROM users WHERE secure='$secure'");
		$delete2 = mysqli_query($con,"DELETE FROM ads WHERE uid='$uid'");
		if($delete && $delete2){
			
			echo 'kustutatud';
			
		}else{
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}
	}else{
		echo "Vabandust, kuid midagi läks valesti.";
	}
}

?>