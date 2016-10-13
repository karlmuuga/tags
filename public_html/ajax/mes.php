<?php
if(!empty(preg_match("/^[a-zA-Z '-]*$/",$_POST['name']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && $_POST['email']) && !empty($_POST['name']) && !empty($_POST['mes']) && $_POST['mes'] != ""){
	include '../includes/c.php';
	$email = strtolower(mysqli_real_escape_string($con,$_POST['email']));
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$mes = mysqli_real_escape_string($con,$_POST['mes']);
	$mail = "Saabunud on uus tagasiside.\n\nSaatja: $name ($email)\n\n$mes";
	mail("info@tags.ee","Tagasiside meil",$mail);
	die("1");
}else{
echo "0";}
?>