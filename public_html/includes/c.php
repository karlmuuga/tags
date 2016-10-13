<?php

$con = mysqli_connect("5.10.94.13", "tagsite_tagsite", "ZxnLqBNjAbBfUqx4", "tagsite_tags");

if(!$con){

	echo 'Could not connect: '.mysqli_error($con);

}else{

mysqli_set_charset($con, 'utf8');
}

?>