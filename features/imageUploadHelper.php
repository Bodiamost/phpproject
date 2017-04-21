<?php 
function uploadImage($target_dir,&$target_name,$feature='place')
{
	$target_name = $target_name.'.'.pathinfo(basename( $_FILES[$feature."_image"]["name"]),PATHINFO_EXTENSION);
	$target_file = $target_dir.$target_name;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$message = '';
	// Check if image file is a actual image or fake image
	if(isset($_POST["add"])) {
	    $check = getimagesize($_FILES[$feature."_image"]["tmp_name"]);
	    if($check !== false) {
	        $message = "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        $message = "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $message = "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES[$feature."_image"]["size"] > 500000) {
	    $message = "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $message = $message. "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    $message = $message. "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES[$feature."_image"]["tmp_name"], $target_file)) {
	        $message = $message. "The file ". basename( $_FILES[$feature."_image"]["name"]). " has been uploaded.";
	    } else {
	        $message = $message. "Sorry, there was an error uploading your file.";
	    }
	}
	return $message;
}
?>