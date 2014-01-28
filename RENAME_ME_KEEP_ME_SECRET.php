<?php

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];



$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 
$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'FOLDER/'; 
$useViewer = false;


$tempFile = $_FILES['media']['tmp_name'];
$imginfo_array = getimagesize($tempFile);

$mime_type = $_FILES['media']['type'];
$mime_array = array("video/mp4", "image/jpeg", "image/gif", "image/png", "video/quicktime");

if (in_array($mime_type, $mime_array)) {
  if ($_FILES["media"]["error"] > 0) {
        die("error");
	} else {
		$extension = end(explode(".", $_FILES["media"]["name"]));
		$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'FOLDER/'; 
		$urlDisplayName = "";
		if	(($mime_type=="video/mp4") || ($mime_type=="video/quicktime")) {
			$id = uniqid();
			$newFileName = ("video" . $id . "." . $extension);
		} else if (($mime_type=="image/jpeg") || ($mime_type=="image/gif") || ($mime_type=="image/png")) {
			$id = uniqid();
			$newFileName = ($rand . "." . $extension);
		} else {
			die("Invalid File 1");
		}
		if (file_exists($newFileName)) {
		  die("Error Uploading");
		} else {
		  move_uploaded_file($_FILES["media"]["tmp_name"],
		  $uploadsDirectory . $newFileName);
		  $urlToReply = ("YOUR_DOMAIN_HERE/FOLDER/" . $newFileName);
		  echo (json_encode(array("url"=>$urlToReply)));
		}
	}
} else {
  die("Error.");
}
?>