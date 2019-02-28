<?php
include ("includes/function_print_gallery.php");
$counter = array_search($_GET['mode'], $episode_pages2);
$value = $episode_pages2[$counter];
$episode_page_name = "".$episode_name." High Def caps ".$_GET['mode']."";
include("header.inc");
$next_page = $episode_pages2[$counter + 1];
$last_page = $episode_pages2[$counter - 1];
$last_image = end($episode_pages2);
print "<center>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url/hd/$last_page\">Previous 100</a>";
if ($last_image!=$value){
	print "&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/$url/hd/$next_page\">Next 100</a>";
}//end if
print "<br />
<font face=\"Arial Black\" size=\"4\">High Def Screen Caps $value for the episode $episode_name</font><br />
<table border=\"0\" width=\"650\">";
	print print_gallery("$photogallery", $value);
	print "
</table>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url/hd/$last_page\">Previous 100</a>";
if ($last_image!=$value){
	print "&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/$url/hd/$next_page\">Next 100</a>";
}//end if
print "<br />
<font face=\"Arial Black\" size=\"4\">High Def Screen Caps $value for the episode $episode_name</font></center>";
?>