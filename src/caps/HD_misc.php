<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "HD Images from the Finale";
$url = "HD_misc";
$photogallery = "HD_misc";


include ("includes/function_print_gallery.php");
$episode_page_name = "$episode_name";
include("header.inc");
 print "<center><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp;<a href=\"season4promo.php\">Episode Index</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps for $episode_name</font><br /><table border=\"0\" width=\"650\">";
		  print print_gallery("$photogallery", "1-100");
		  print "</table></center>";
include("footer.inc");
?>