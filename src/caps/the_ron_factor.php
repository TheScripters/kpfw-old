<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "The Ron Factor";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-716");
$url = "the_ron_factor";
$photogallery = "25_The_Ron_Factor";


if ($_GET['mode'] == ""){  
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