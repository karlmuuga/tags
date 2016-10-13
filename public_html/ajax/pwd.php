<?php session_start();
if(isset($_SESSION['token']) && isset($_POST['newPwdrep']) && isset($_POST['newPwd']) && $_POST['newPwd'] != "" && $_POST['newPwdrep'] != "" && $_POST['newPwd'] === $_POST['newPwdrep']){
	
	$password = hash("sha512", $_POST['oldPwd']);
	$secure = $_SESSION['token'];
	include '../includes/c.php';
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure' AND password='$password'");
	if($select && mysqli_num_rows($select) == 1){
		$pwd = hash("sha512", $_POST['newPwd']);
		$change = mysqli_query($con,"UPDATE users SET password='$pwd' WHERE secure='$secure'");
		
		if(!$change){
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}else{
			
			echo 'success';
		}
	}else{
		echo "Palun jälgi, et vana parool oleks õige";
	}
}else{
	echo "Palun jälgi, et paroolid kattuksid!";
}

?>