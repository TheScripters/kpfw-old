<?php

error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$episode_name = "Clean Slate";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1221");
$url = "clean_slate";
$episode_pages2 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1200", "1201-1300", "1301-1400", "1401-1500", "1501-1600", "1601-1642");

if ($_GET['mode'] == ""){  
  include ("includes/print_index_hd.php");
}else {
  if ($_GET['v']!="hd"){
      $photogallery = "clean_slate";
	  if ($_GET['mode'] == "1-100"){
			 include ("includes/first-100.php");
	  } else {
			include ("includes/main_pages.php");
	  }//end if
  }else{
	  	$photogallery = "clean_slate_hd";
		if ($_GET['mode'] == "1-100"){
			 include ("includes/first-100_hd.php");
		} else {
			include ("includes/main_pages_hd.php");
	   }//end if
  }
}//end if
include("footer.inc");
?>