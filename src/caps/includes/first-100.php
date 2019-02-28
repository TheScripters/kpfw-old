<?php
include ("includes/function_print_gallery.php");
$episode_page_name = "".$episode_name." caps 1-100";
include("header.inc");
 print "<center>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url/101-200\">Next 100</a><br />
<font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $episode_name</font><br />
<table border=\"0\" width=\"650\">";
print print_gallery("$photogallery", "1-100");
print "
</table>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
<a href=\"http://caps.kpfanworld.com/$url/101-200\">Next 100</a><br />
<font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $episode_name</font></center>";
?>