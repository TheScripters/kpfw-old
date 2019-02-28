<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "Rufus Vs. Commodore Puddles";
$episode_pages = array ("1-100", "101-200", "201-300", "301-340");
$url = "rufus_vs_commodore_puddles";
$photogallery = "33a_Rufus_Vs_Commodore_Puddles";


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