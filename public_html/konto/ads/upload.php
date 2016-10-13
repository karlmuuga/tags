<?php
if (isset ( $_FILES ["file"] ["type"] )) {
	$validextensions = array (
			"jpeg",
			"jpg",
			"png" 
	);
	$temporary = explode ( ".", $_FILES ["file"] ["name"] );
	$file_extension = strtolower ( end ( $temporary ) );
	if ((($_FILES ["file"] ["type"] == "image/png") || ($_FILES ["file"] ["type"] == "image/jpg") || ($_FILES ["file"] ["type"] == "image/jpeg")) && ($_FILES ["file"] ["size"] < 3000000) && in_array ( $file_extension, $validextensions )) {
		if ($_FILES ["file"] ["error"] > 0) {
			echo "Return Code: " . $_FILES ["file"] ["error"] . "<br/><br/>";
		} else {
			$key = md5 ( uniqid ( rand (), true ) );
			$name = substr ( $key, 0, 8 );
			$sourcePath = $_FILES ['file'] ['tmp_name']; // Storing source path of the file in a variable
			$targetPath = "../../img/uploads/$name.$file_extension"; // Target path where file is to be stored
			move_uploaded_file ( $sourcePath, $targetPath ); // Moving Uploaded file
			echo "http://tags.ee/img/uploads/$name.$file_extension";
		}
	} else {
		echo "<span id='invalid'>***Invalid file Size or Type***<span>";
	}
}
?>