<?php

error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "Chasing Rufus";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-815");
$url = "chasing_rufus";
$photogallery = "chasing_rufus";

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