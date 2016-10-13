<?php session_start();
include '../includes/c.php';
//MUUDA AADRESSI
if(isset($_SESSION['token']) && isset($_POST['mail']) && !empty($_POST['mail']) && filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
	
	$secure = $_SESSION['token'];
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if($select && mysqli_num_rows($select) == 1){
		
		$massiiv = mysqli_fetch_array($select);
		$prev = $massiiv['email'];
		$mail = mysqli_real_escape_string($con,$_POST['mail']);
		$key = md5(uniqid(rand(), true));
		$pwd =substr($key,0,8);
		mail($mail,"TAGs.ee","Tere!\n\nKasutaja aadressiga $prev soovib teie meiliaadressi kasutada. Kui lubate seda, palun klikkige sellel lingil: http://www.tags.ee/ajax/mail.php?akt=$pwd \n\nParimaga, \nTAGs.ee");
		$change = mysqli_query($con,"UPDATE users SET muuda_v6ti='$pwd',newmail='$mail' WHERE secure='$secure'");
		if($change){
			
			echo 'success';
			
		}else{
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}
	}else{
		echo "Vabandust, kuid midagi läks valesti.";
	}
}else{
	echo "<span style='color:red'>Palun sisestage kõik andmed korrektselt!</span>";
}
//AKTIVEERI MUUDETUD AADRESS
if(isset($_GET['akt'])){
	
	$pwd = mysqli_real_escape_string($con,$_GET['akt']);
	$check = mysqli_query($con,"SELECT * FROM users WHERE muuda_v6ti='$pwd'");
	
	if($check && mysqli_num_rows($check) == 1){
		$array = mysqli_fetch_array($check);
		$mail = $array['newmail'];
		$change = mysqli_query($con,"UPDATE users SET email='$mail',newmail='' WHERE muuda_v6ti='$pwd'");
		if($change && $change2 && $change3){
			header("Location: http://www.tags.ee");
		}else{
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
	}
	}else{
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
	}
}
//AKTIVEERI ESMANE KASUTAJA
if(isset($_GET['ver'])){
	
	$akt = mysqli_real_escape_string($con,$_GET['ver']);
	$check = mysqli_query($con,"SELECT * FROM users WHERE muuda_v6ti='$akt'");
	
	if($check && mysqli_num_rows($check) == 1){
		$array = mysqli_fetch_array($check);
		
		$change = mysqli_query($con,"UPDATE users SET activated='Aktiveeritud',muuda_v6ti='' WHERE muuda_v6ti='$akt'");
		if($change){
			header("Location: http://www.tags.ee/sisene/?a=1");
		}else{
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
	}
	}else{
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
	}
}
?>