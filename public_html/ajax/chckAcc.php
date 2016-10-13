<?php session_start();include '../includes/c.php';

if(isset($_SESSION['token'])){
	$secure = $_SESSION['token'];
	$check = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'") or die(mysqli_error($con));
	if(mysqli_num_rows($check)==1){
		die("1");
	}

}elseif(!empty($_POST['logemail']) && !empty($_POST['logpassword'])){
	$email = strtolower(mysqli_real_escape_string($con, $_POST['logemail']));
    $password = hash("sha512", $_POST['logpassword']);
	$result = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password' AND activated='Aktiveeritud'") or die(mysqli_error($con));
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['token'] = $row['secure'];
		}
		die("1");
	}else{
		die("0"."SELECT * FROM users WHERE email='$email' AND password='$password' AND activated='Aktiveeritud'");
	}
}
?>