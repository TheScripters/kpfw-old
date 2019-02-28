<?php

error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "The Big Job in HD test";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-537");
$url = "HD_test";
$photogallery = "test";

if ($_GET['mode'] == ""){  
  print"<center><font color=\"#FFFFFF\"><h1>Warning! Spoilers Contained Within!</h1></font></center>";
  include ("includes/print_index.php");
}else {
  if ($_GET['mode'] == "1-100"){
		 include ("includes/first-100.php");
	} else {
		include ("includes/main_pages.php");
  }//end if
}//end if
include("footer.inc");
?>