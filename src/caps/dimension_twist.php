<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "Dimension Twist";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-695");
$url = "dimension_twist";
$episode_pages2 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1068");

if ($_GET['mode'] == ""){  
  include ("includes/print_index_hd.php");
}else {
  if ($_GET['v']!="hd"){
      $photogallery = "57_Dimension_Twist";
	  if ($_GET['mode'] == "1-100"){
			 include ("includes/first-100.php");
	  } else {
			include ("includes/main_pages.php");
	  }//end if
  }else{
	  	$photogallery = "dimension_twist_hd";
		if ($_GET['mode'] == "1-100"){
			 include ("includes/first-100_hd.php");
		} else {
			include ("includes/main_pages_hd.php");
	   }//end if
  }
}//end if
include("footer.inc");
?>