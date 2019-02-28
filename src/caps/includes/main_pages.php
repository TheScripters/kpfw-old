<?php
include ("includes/function_print_gallery.php");
$counter = array_search($_GET['mode'], $episode_pages);
$value = $episode_pages[$counter];
$episode_page_name = "".$episode_name." caps ".$_GET['mode']."";
include("header.inc");
$next_page = $episode_pages[$counter + 1];
$last_page = $episode_pages[$counter - 1];
$last_image = end($episode_pages);
print "<center>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url/$last_page\">Previous 100</a>";
if ($last_image!=$value){
	print "&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/$url/$next_page\">Next 100</a>";
}//end if
print "<br />
<font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $episode_name</font><br />
<table border=\"0\" width=\"650\">";
	print print_gallery("$photogallery", $value);
	print "
</table>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url/$last_page\">Previous 100</a>";
if ($last_image!=$value){
	print "&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/$url/$next_page\">Next 100</a>";
}//end if
print "<br />
<font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $episode_name</font></center>";

?>