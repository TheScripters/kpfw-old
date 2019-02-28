<?php
include("includes/functions.php");
incheader("Middleton High Signs");
include("includes/guides_table.inc");
if (!$_GET['ep']){
	include("function_print_gallery.php");
	$photogallery="season_1";
	print "<h3><b>Season 1</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="season_2";
	print "<h3><b>Season 2</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="season_3";
	print "<h3><b>Season 3</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="season_4";
	print "<h3><b>Season 4</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "</table>";
}else{
  	print "<br><br><a href=\"signs\">Back</a><br><img src=\"images/school_signs/".$_GET['ep']."/".$_GET['pic']."\" alt=\"".$_GET['pic']."\"><br>";
}
footer();
?>	