<?php
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "TVF-VillainParty";
$url = "TVF-VillainParty";
$photogallery = "TVF-VillainParty";


include ("includes/function_print_gallery.php");
$episode_page_name = $episode_name;
include("header.inc");
 print "<center><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp;<br /><font face=\"Arial Black\" size=\"4\">Screen Caps for $episode_name</font><br /><table border=\"0\" width=\"650\">";
		  print print_gallery("$photogallery", "1-115");
print "</table><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp;<br /><font face=\"Arial Black\" size=\"4\">Screen Caps for $episode_name</font></center><br />";
include("footer.inc");
?>