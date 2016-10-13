<?php
if(isset($_GET['email']) && $_GET['email'] != ""){
	include '../includes/c.php';
	$email = urldecode(strtolower(mysqli_real_escape_string($con,$_GET['email'])));
	$check = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
	if($check && mysqli_num_rows($check) == 1){
		$key = md5(uniqid(rand(), true));
		$pwd =substr($key,0,8);
        $pwd2 = hash("sha512", $pwd);
		$set = mysqli_query($con,"UPDATE users SET password='$pwd2' WHERE email='$email'");
		if($set){
			
			$sisu = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Parooli lähtestamine</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
  </head>
  
  <body style="color: rgb(96, 125, 138);font-family: "HelveticaNeue", "Helvetica Neue", "Arial Black", sans-serif; font-weight:700; font-stretch:normal">
    <div class="header" style="background: rgb(96, 125, 138);width:100%;margin-bottom: 25px;color: white;font-size: 36px;text-align: center;">TAGs</div>
	<div class="content" style="width:40%;margin: 0 auto">
	<h1 style="font-size: 36px">Tere!</h1>
	<h2 style="font-size: 24px">Tellisid endale hiljuti uue parooli.</h2>
	<h2 style="font-size: 24px">Teie uus parool on: '.$pwd.'</h2>
	<div class="button" style="text-align: center"><a href="tags.ee/sisene">Logi sisse</a></div>
	<p style="font-size: 18px">Parooli saad muuta sobivaks Minu Konto alt</p>
	<p style="font-size: 18px">Kui sa ei tellinud endale uut parooli, siis anna sellest <a href="tags.ee/kkk">meile teada</a></p>
	</div>
  </body>
</html>';
			$headers = "From: " . strip_tags("TAGs meeskond") . "\r\n";
			$headers .= "Reply-To: ". strip_tags("info@tags.ee") . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			
			mail($email,"TAGs.ee",$sisu,$headers);
			echo '<span style="color:green">Teie uus parool on edukalt saadetud aadressile '.$email.!'</span>';
		}
	}
}