<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "A Very Possible Christmas";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1200", "1201-1300", "1301-1400", "1401-1502");
$url = "a_very_possible_christmas";
$photogallery = "37_A_Very_Possible_Christmas";


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