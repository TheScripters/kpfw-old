<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******avhosting.php************/
include("includes/functions.php");
if ($_SESSION['logged_in'] && !$_GET['mode']){
  if (!file_exists("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName'])){
    incheader("Enable Avatar Hosting");
    echo "Would you like to enable the avatar hosting?<br>";
    echo "<form action=\"avhosting.php?mode=create\" method=\"post\">\n";
    echo "<b>Yes</b> <input type=\"radio\" name=\"activateHost\" value=\"True\"><br>\n";
    echo "<b>No</b> <input type=\"radio\" name=\"activateHost\" value=\"False\"><br>\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br><br>";
    footer();
  }else{
    incheader("Avatar Hosting");
    include("includes/avhost.php");
    footer();
  }//end if
}elseif ($_SESSION['logged_in'] && $_GET['mode'] == "create"){
  if ($_REQUEST['activateHost'] == "True"){
    mkdir("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."");
    chmod("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."",0777);
    header("Location: avhosting");
  } else {
    header("Location: index.php");
  }//end if
}elseif ($_SESSION['logged_in'] && $_GET['mode'] == "upload"){
	  $dir = "/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/";
	  $newfile = $dir.basename($_FILES['avatar']['name']);
	  $file_extension_allowed = array("jpg","jpeg","png","gif","bmp");// file extensions to accept
	  if (in_array(strtolower(array_pop(explode('.', $_FILES['avatar']['name']))), $file_extension_allowed))//makes sure the file being uplaoded is of the correct file format
	  {
	  	if (move_uploaded_file($_FILES['avatar']['tmp_name'], $newfile))
		{
	  		$sql = mysql_query("INSERT INTO kpfw_avhosting VALUES ('".basename($_FILES['avatar']['name'])."', '".$_SESSION['userID']."', '".$_FILES['avatar']['size']."')");
	  		header("Location: avhosting");
	  	}else{
	  	  	incheader("Avatar Hosting");
	  	  	print "<br><br><center><h4>Your Image could not be uplaoded, please try again</h4><br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	  	footer();
	  	}
	  }else{
	  	incheader("Avatar Hosting");
	  	print "<br><br><center><h4>Your Image could not be uplaoded it was not the proper file format, please try again</h4><br>The supported file formats are jpg, png, gif, and bmp<br><a href=\"http://www.kpfanworld.com/avhosting\">Continue</a></center><br><br>";
	  	footer();
	  }
}elseif (!$_SESSION['logged_in']){
  header("Location: index.php");
}
?>
