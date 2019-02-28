<?php
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******resize.php************/
include("includes/functions.php");
$orig = $_REQUEST['orig_name'];
//because the extension is removed from the string supplied to the user this
//checks to see what extention is on the origional file, and will readd the extention to the new name
if ($_REQUEST['new_name'] != ""){
	if (substr($orig, strlen($orig)-4, 4)==".jpg"){
		$new_name = "".$_REQUEST['new_name'].".jpg";
	}else if (substr($orig, strlen($orig)-4, 4)==".gif"){
		$new_name = "".$_REQUEST['new_name'].".gif";
	}else if (substr($orig, strlen($orig)-4, 4)==".png"){
		$new_name = "".$_REQUEST['new_name'].".png";
	}//end if
}else {
	  header("Location: avhosting");
}//end if
if ($_GET['mode'] == "resize"){
	/*
	Example 2. Resampling an image proportionally
	Source http://us3.php.net/manual/en/function.imagecopyresampled.php */
		// Set a maximum height and width
	$width = $_REQUEST['width'];
	$height = $_REQUEST['height'];
	$pic = $_REQUEST['picture'];
	if ($width == "" || height == "" || $height == 0 || $width == 0){
	  header("Location: avhosting");
	}//end if
	// The file
	$filename = "/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/$pic";
	// Get new dimensions
	list($width_orig, $height_orig) = getimagesize($filename);
	$ratio_orig = $width_orig/$height_orig;
	if ($width/$height > $ratio_orig) {
   		$width = $height*$ratio_orig;
	} else {
   	$height = $width/$ratio_orig;
	}//end if
	// Resample
	$image_p = imagecreatetruecolor($width, $height);
	// Output
	if (substr($pic, strlen($pic)-4, 4)==".jpg"){
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		if (imagejpeg($image_p, $filename, 100))
		{
		  	$new_file_size = filesize($filename);
			$sql = mysql_query("UPDATE kpfw_avhosting SET File_Size = '$new_file_size' WHERE AvFilename = '$pic'");
			header("Location: avhosting");
		}else{
		  	incheader("Avatar Hosting");
	  	  	print "<br><br><center><h4>Your Image could not be resized, please try again</h4><br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	  	footer();
	  	}
	}else if (substr($pic, strlen($pic)-4, 4)==".gif"){
		$image = imagecreatefromgif($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		if (imagegif($image_p, $filename, 100))
		{
		  	$new_file_size = filesize($filename);
			$sql = mysql_query("UPDATE kpfw_avhosting SET File_Size = '$new_file_size' WHERE AvFilename = '$pic'");
			header("Location: avhosting");
		}else{
		  	incheader("Avatar Hosting");
	  	  	print "<br><br><center><h4>Your Image could not be resized, please try again</h4><br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	  	footer();
	  	}
	}else if (substr($pic, strlen($pic)-4, 4)==".png"){
		$image = imagecreatefrompng($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		if (imagepng($image_p, $filename, 100))
		{
		  	$new_file_size = filesize($filename);
			$sql = mysql_query("UPDATE kpfw_avhosting SET File_Size = '$new_file_size' WHERE AvFilename = '$pic'");
			header("Location: avhosting");
		}else{
		  	incheader("Avatar Hosting");
	  	  	print "<br><br><center><h4>Your Image could not be resized, please try again</h4><br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	  	footer();
	  	}
	}//end if
}else if ($_GET['mode'] == "rename"){
	//updates the name of the file in the data base, and then on the server
	if (rename("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/$orig", "/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/$new_name"))
	{
	  	$sql = mysql_query("UPDATE kpfw_avhosting SET AvFilename = '$new_name' WHERE AvFilename = '$orig'");
		header("Location: avhosting");
	}else{
	  	incheader("Avatar Hosting");
	  	print "<br><br><center>There was an error renaming your file, please try again<br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	footer();
	}
}else if ($_GET['mode'] == "copy"){
	if (copy ("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/$orig", "/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/$new_name"))
	{
		$file_size = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_avhosting WHERE AvFilename = '$orig' and UserId = '".$_SESSION['userID']."'"));
		//adds the name of the file in the data base
		$sql = mysql_query("INSERT INTO kpfw_avhosting VALUES ('$new_name', '".$_SESSION['userID']."', '".$file_size['File_Size']."')");
		header("Location: avhosting");
	}else{
	  	incheader("Avatar Hosting");
	  	print "<br><br><center>There was an error copying your file, please try again<br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	footer();
	}
}//end if
?> 
