<?php error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();
include $_SERVER['DOCUMENT_ROOT'].'/includes/c.php';

if(isset($_SESSION['token']) && isset($_GET['id'])){
	
	$id = $_GET['id'];
	$secure = $_SESSION['token'];
	$select = mysqli_query($con,"SELECT * FROM users WHERE secure='$secure'");
	
	if($select && mysqli_num_rows($select) == 1){
		
		$result = mysqli_fetch_array($select);
		$uid = $result['id'];
		$ctrl = mysqli_query($con,"SELECT * FROM ads WHERE uid='$uid' AND id='$id'");
		
		if(!$ctrl){
			
			echo "Vabandust, kuid midagi läks valesti.".mysqli_error($con);
			
		}else{
			
			if(mysqli_num_rows($ctrl)==0){
				
				echo "Sa ei saa seda kuulutust kustutada!";
				
			}else{
				$delete = mysqli_query($con,"DELETE FROM ads WHERE uid='$uid' AND id='$id'");
				
				if($delete){
					
					echo "kustutatud";
					
				}else{
					
					echo "Vabandust, kuid midagi läks valesti..".mysqli_error($con);
					
				}
				
			}
		}
	}
}

?>