<?php error_reporting(E_ALL); ini_set('display_errors', 1);session_start();

if(isset($_SESSION['token'])){
	
	$error = array();
	$secure = $_SESSION['token'];
	include '../includes/c.php';
	$check = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	$arr = mysqli_fetch_array($check);
	$uid = $arr['id'];

			if(isset($_POST['kategooria']) && $_POST['kategooria'] != "" && strlen($_POST['kategooria']) <100){
				$cat = mysqli_real_escape_string($con,$_POST['kategooria']);
				/*if($cat != "Muu" OR $cat != "Festival" OR $cat != "Kino" OR $cat != "Muusika" OR $cat != "Teater" OR $cat != "Sport" OR $cat != "Kinkekaardid"){
					$error[] = "<span style='color:red'>Palun sisestage korrektne kategooria!</span>";
				}*/
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne kategooria!</span>";
			}
			
			if(isset($_POST['kuup2ev']) && $_POST['kuup2ev'] != ""){
				date_default_timezone_set('Europe/Tallinn');
				$date = mysqli_real_escape_string($con,$_POST['kuup2ev']);
				$dateArr = explode("-",$date);
				/*if(count($dateArr) != 3){
					if(!checkdate($dateArr[0],$dateArr[1],$dateArr[2])){$error[] = $mess;}
				}else{
					$error[] = "<span style='color:red'>Palun sisestage korrektne kuupäev!</span>";
				}*/
			}else{
					$error[] = "<span style='color:red'>Palun sisestage korrektne kuupäev!</span>";
			}
			
			if(isset($_POST['time']) && $_POST['time'] != "" && strlen($_POST['time']) <100){
				$time = mysqli_real_escape_string($con,$_POST['time']);
				$timeArr = explode(".",$time);
				/*if(count($timeArr) != 2){
					*/
					}else{$error[] = "<span style='color:red'>Palun sisestage korrektne kellaaeg!</span>";} 
				
			
			
			if(isset($_POST['pealkiri']) && $_POST['pealkiri'] != ""){
				$title = mysqli_real_escape_string($con,$_POST['pealkiri']);
				if(strlen($title) < 3){
					$error[] = "<span style='color:red'>Pealkiri peab sisaldama vähemalt kolme tähte!</span>";
				}elseif(strlen($title) > 50){
					$error[] = "<span style='color:red'>Pealkiri ei tohi ületada 50 tähemärki!</span>";
				}
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne pealkiri!</span>";
			}
			
			if(isset($_POST['kirjeldus']) && $_POST['kirjeldus'] != ""){
				$descri = mysqli_real_escape_string($con,$_POST['kirjeldus']);
				if(strlen($descri) < 3){
					$error[] = "<span style='color:red'>Kirjeldus peab sisaldama vähemalt kolme tähte!</span>";
				}if(strlen($descri) > 300){
					$error[] = "<span style='color:red'>Kirjeldus ei tohi ületada 300 tähemärki!</span>";
				}
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne kirjeldus!</span>";
			}
			
			if(isset($_POST['asukoht']) && $_POST['asukoht'] != "" && strlen($_POST['asukoht']) <100){
				$state = mysqli_real_escape_string($con,$_POST['asukoht']);
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne asukoht!</span>";
			}
			
			if(isset($_POST['aadress']) && $_POST['aadress'] != "" && strlen($_POST['aadress']) <100){
				$addr = mysqli_real_escape_string($con,$_POST['aadress']);
			}else{
				$addr = "";
			}
			
			if(isset($_POST['hind']) && $_POST['hind'] != ""){
				$pricekoma = mysqli_real_escape_string($con,$_POST['hind']);
				if(!is_numeric($pricekoma)){
					$error[] = "<span style='color:red'>Palun sisestage korrektne hind!</span>";
				}else{
					$price = str_replace(',', '.', $pricekoma);
					if($price < 0 OR $price > 600 ){
						$error[] = "<span style='color:red'>Palun sisestage korrektne hind!</span>";
					}
				}
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne hind!</span>";
			}
			
			if(isset($_POST['kogus']) && $_POST['kogus'] != "" && is_numeric($_POST['kogus'])){
				$qty = mysqli_real_escape_string($con,$_POST['kogus']);
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne kogus!</span>";
			}
			
			/*	if(isset($_POST['ad1']) && $_POST['ad1'] != "" && is_numeric($_POST['ad1']) && $_POST['ad1'] % 2 == 0 && strlen($_POST['ad1']) <100){
				$ad1 = mysqli_real_escape_string($con,$_POST['ad1']);
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne esimene reklaamikogus!</span>";
			}
			
				if(isset($_POST['ad2']) && $_POST['ad2'] != "" && is_numeric($_POST['ad2']) && $_POST['ad2'] % 2 == 0 && strlen($_POST['ad2']) <100){
				$ad2 = mysqli_real_escape_string($con,$_POST['ad2']);
			}else{
				$error[] = "<span style='color:red'>Palun sisestage korrektne teine reklaamikogus!</span>";
			}*/
			if(isset($_POST['pic']) && $_POST['pic'] != ""){
				
				if(filter_var($_POST['pic'], FILTER_VALIDATE_URL) == true){
					$pic = mysqli_real_escape_string($con,urlencode($_POST['pic']));
				}
			}else{
				$pic = urlencode("http://tags.ee/img/none.jpg");
			}
			
			if(isset($_POST['type']) && $_POST['type'] != ""){
				$type = mysqli_real_escape_string($con,$_POST['type']);
			}else{
				$type = "Pole";
			}
			
			if(count($error) == 0){
				$insert = mysqli_query($con, "INSERT INTO ads VALUES ('','$uid','$cat','$date','$time','$title','$descri','$state','$addr','$pic','$price','$qty','0','0','$type')");
				if(!$insert){
					echo "<span style='color:red'>Vabandust, kuid midagi läks valesti.. ".mysqli_error($con)."</span>";
				}else{
					$check = mysqli_query($con, "SELECT * FROM ads WHERE title='$title'");
					$etid = mysqli_fetch_array($check);
					$id = $etid[0];
					echo "<span id='aide' style='display:none'>$id</span><span style='color:green'>Teie kuulutus pealkirjaga $title on edukalt lisatud!</span>";
				}
			}else{
				foreach($error as $value){
					echo $value."<br>";
				}
			}
}
?>
