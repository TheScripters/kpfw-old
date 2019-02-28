<?php
$episode_page_name = $episode_name;
include("header.inc");
print"<center>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a><br /><br />
<font face=\"Arial Black\" size=\"4\">Normal Def Screen Caps for the episode $episode_name</font>
<br />
<table border=\"1\" style=\"border-collapse: collapse\"><tr>";
  foreach ($episode_pages as $value){
    	print "<td><a href=\"http://caps.kpfanworld.com/$url/$value\">$value</a></td>";
  }//end for
print "</tr></table><br /><br />
<font face=\"Arial Black\" size=\"4\">High Def Screen Caps for the episode $episode_name</font>
<br />
<table border=\"1\" style=\"border-collapse: collapse\"><tr>";
  foreach ($episode_pages2 as $value){
    	print "<td><a href=\"http://caps.kpfanworld.com/$url/hd/$value\">$value</a></td>";
  }//end for
print "</tr></table></center>";
?>