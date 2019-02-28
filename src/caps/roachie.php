<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "Roachie";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-590");
$episode_pages2 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-535");
$url = "roachie";

if ($_GET['mode'] == ""){  
  include ("includes/print_index_hd.php");
}else {
  if ($_GET['v']!="hd"){
      $photogallery = "58b Roachie Pics";
	  if ($_GET['mode'] == "1-100"){
			 include ("includes/first-100.php");
	  } else {
			include ("includes/main_pages.php");
	  }//end if
  }else{
	  	$photogallery = "roachie_hd";
		if ($_GET['mode'] == "1-100"){
			 include ("includes/first-100_hd.php");
		} else {
			include ("includes/main_pages_hd.php");
	   }//end if
  }
}//end if
include("footer.inc");
?>