<?php
include ("includes/function_print_gallery.php");
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name1 = "34 A Sitch in Time Present (1)";
$episode_pages1 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1200", "1201-1270");
$photogallery1 = "34 A Sitch in Time Present (1) pics";
//////////////////////////
$episode_name2 = "35 A Sitch in Time Past (2)";
$episode_pages2 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1200", "1201-1252");
$photogallery2 = "35 A Sitch in Time Past (2) Pics";
//////////////////////////
$episode_name3 = "36 A Sitch in Time Future (3)";
$episode_pages3 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1219");
$photogallery3 = "36 A Sitch in Time Future (3) pics";
$url = "ASIT";


if ($_GET['mode'] == ""){  
  	$episode_page_name = "A Sitch In Time Parts 1-3";
	include ("header.inc");
  	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a></center>";
  	print_index($episode_name1, $episode_pages1, $url, 1);
  	print_index($episode_name2, $episode_pages2, $url, 2);
  	print_index($episode_name3, $episode_pages3, $url, 3);
}else {
  if ($_GET['mode'] == "1-100"){
		 if ($_GET['ep'] == "1"){
		   print_first_100($episode_name1, $url, $photogallery1);
		}else if ($_GET['ep'] == "2"){
		  print_first_100($episode_name2, $url, $photogallery2);
		}else if ($_GET['ep'] == "3"){
		  print_first_100($episode_name3, $url, $photogallery3);
		}//end if
	} else {
	if ($_GET['ep'] == "1"){
		   print_main_pages($episode_name1, $url, $photogallery1, $episode_pages1);
		}else if ($_GET['ep'] == "2"){
		  print_main_pages($episode_name2, $url, $photogallery2, $episode_pages2);
		}else if ($_GET['ep'] == "3"){
		  print_main_pages($episode_name3, $url, $photogallery3, $episode_pages3);
	}//end if
  }//end if
}//end if
include("footer.inc");

////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////PRINTS THE INDEX/////////////////////////////////
function print_index($ep, $pages, $url, $episode){
  print "<center><br /><br /><font face=\"Arial Black\" size=\"4\">Screen Caps for the episode $ep</font><br /><table border=\"1\" style=\"border-collapse: collapse\"><tr>";
  foreach ($pages as $value){
    $counter++;
    	print "<td><a href=\"http://caps.kpfanworld.com/$url/$episode/$value\">$value</a></td>";
  }//end for
	print "</tr></table></center><br /><br />";
}//end function
////////////////////////////////////////////////////////////////////////////////////////
//////////////////////PRINTS THE PAGE 1-100 FOR EACH EP/////////////////////////////////
function print_first_100($ep, $url, $photogallery){
  	$episode_page_name = "".$ep." caps 1-100";
	include ("header.inc");
	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/101-200\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $ep</font><br /><table border=\"0\" width=\"650\">";
	print print_gallery("$photogallery", "1-100");
	print "</table><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/101-200&amp;ep=\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $ep</font></center>";
}//end function
////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////PRINTS THE THE MAIN PAGES OF THE EPISODES/////////////////////////////////
function print_main_pages($ep, $url, $photogallery, $pages){
	$counter = array_search($_GET['mode'], $pages);
	$value = $pages[$counter];
	$next_page = $pages[$counter + 1];
	$last_page = $pages[$counter - 1];
	$last_image = end($pages);
	$episode_page_name = "".$ep." caps ".$value."";
	include ("header.inc");
	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last_page\">Previous 100</a>";
	if ($last_image!=$value){
	  	print "&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$next_page\">Next 100</a>";
	}//end if
	print "<br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font><br /><table border=\"0\" width=\"650\">";
	print print_gallery("$photogallery", $value);
	print "</table><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last_page\">Previous 100</a>";
	if ($last_image!=$value){
	  	print "&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$next_page\">Next 100</a>";
	}//end if
	print "<br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font></center>";
}//end function
?>