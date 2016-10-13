<?php session_start();
include "../includes/h.php";

    if (filter_var($_POST['rfemail'], FILTER_VALIDATE_EMAIL) && !empty($_POST['rfpassword']) && !empty($_POST['rfpasswordrepeat']) && !empty($_POST['phone'])){
		$errormess = "";
        $email = mysqli_real_escape_string($con,$_POST['rfemail']);
		if($_POST['rfpassword'] == $_POST['rfpasswordrepeat']){
        $pass = hash("sha512", $_POST['rfpassword']);}else{$errormess="<span style='color:red'>Palun jälgi, et paroolid kattuksid!</span>";}
		$fullname = $_POST['fullname'];
        $token = md5(uniqid(rand(), true));
		$phone = $_POST['phone'];

		if($errormess == ""){
        $kontrolli = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");

        if (!$kontrolli) {
            echo mysqli_error($con);
        }

        if (mysqli_num_rows($kontrolli) == 0) {
			$key = md5(uniqid(rand(), true));
			$pwd =substr($key,0,8);
		mail($email,"TAGs.ee","Tere!\n\nOlete registreerinud ennast selle meiliaadressiga. Konto aktiveerimiseks klikkige palun sellel lingil: \nhttp://www.tags.ee/ajax/mail.php?ver=$pwd \n\nParimaga, \nTAGs.ee");
            $rega = mysqli_query($con, "INSERT INTO users VALUES ('','$email','$fullname','$pass','$token','$phone','Pole märgitud','Aktiveerimata','','$pwd')");
            if($rega){$errormess = "success";}else{$errormess="<span style='color:red'>Vabandust, kuid midagi läks valesti: ".mysqli_error($con)."</span>";}

        } else {
            $errormess = "<span style='color:red'>Sellise e-mailiga kasutaja on juba olemas!</span>";
        }
		}
    } else {
        $errormess = "<span style='color:red'>Palun sisesta kõik andmed korrektselt!</span>";
    }
	
	echo $errormess;

?>