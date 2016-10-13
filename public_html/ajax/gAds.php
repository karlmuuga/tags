<?php include "../includes/c.php";include "../includes/a.php";

$query = "SELECT * FROM ads WHERE ";

$date = false;
$today = date("Y-m-d");
if(!empty($_GET['start'])){
	if($_GET['start'] != "" AND (empty($_GET['end']) OR $_GET['end'] == "")){
		$start = mysqli_real_escape_string($con,$_GET['start']);
		$date = true;
		$query .= "date BETWEEN CAST('$start' AS DATE) AND CAST('2020-01-01' AS DATE) AND date BETWEEN CAST('$today' AS DATE) AND CAST('2020-01-01' AS DATE) ";
	}
}

if(!empty($_GET['end'])){
	if($_GET['end'] != "" AND (empty($_GET['start']) OR $_GET['start'] == "")){
		$end = mysqli_real_escape_string($con,$_GET['end']);
		$date = true;
		$query .= "date BETWEEN CAST('2014-01-01' AS DATE) AND CAST('$end' AS DATE) AND date BETWEEN CAST('$today' AS DATE) AND CAST('2020-01-01' AS DATE) ";
	}
}
if(!empty($_GET['start']) && !empty($_GET['end'])){
	if($_GET['start'] != "" AND $_GET['end'] != ""){
		$start = mysqli_real_escape_string($con,$_GET['start']);
		$end = mysqli_real_escape_string($con,$_GET['end']);
		$date = true;
		$query .= "date BETWEEN CAST('$start' AS DATE) AND CAST('$end' AS DATE) AND date BETWEEN CAST('$today' AS DATE) AND CAST('2020-01-01' AS DATE) ";
	}
}

if(!empty($_GET['min']) && !empty($_GET['max'])){
	if(is_numeric($_GET['min']) && is_numeric($_GET['max'])){
		$min = mysqli_real_escape_string($con,$_GET['min']);
		$max = mysqli_real_escape_string($con,$_GET['max']);
		if($date){
			$query .= "AND (price BETWEEN $min AND $max) ";
		}else{
			$query .= "price BETWEEN $min AND $max AND date BETWEEN CAST('$today' AS DATE) AND CAST('2020-01-01' AS DATE) ";
		}
	}
}


if(!empty($_GET['cat'])){
	if($_GET['cat'] != ""){
		$cat = mysqli_real_escape_string($con,$_GET['cat']);
		
		$query .= "AND (cat IN ('$cat')) ";
	}
}

if(!empty($_GET['state'])){
	if($_GET['state'] != ""){
		$state = mysqli_real_escape_string($con,$_GET['state']);
		
		$query .= "AND (state IN ('$state'))";
	}
}

$ads = mysqli_query($con,$query);
if($ads){ads($ads);}
?>