<?php
include ("includes/function_print_gallery.php");
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name5 = "High Def Season 4 Opening Sequence";
$episode_pages5 = array ("1-100", "101-158");
$photogallery5 = "season4_opening_hd";
//////////////////////////
$episode_name4 = "Season 4 Opening Sequence";
$episode_pages4 = array ("1-100", "101-197");
$photogallery4 = "season4_opening";
//////////////////////////
$episode_name1 = "Season 1-3 Opening Sequence";
$episode_pages1 = array ("1-100", "101-191");
$photogallery1 = "Opening_Original";
//////////////////////////
$episode_name2 = "TSF Opening Sequence";
$episode_pages2 = array ("1-100", "101-200", "201-273");
$photogallery2 = "TSF_opening";
//////////////////////////
$episode_name3 = "TVF Opening Sequence";
$episode_pages3 = array ("1-100", "101-181");
$photogallery3 = "TVF_Opening";
$url = "opening_sequences";
//////////////////////////
$episode_name6 = "Ron Factor Opening Sequence";
$episode_pages6 = array ("1-100");
$photogallery6 = "ron_factor_intro";
$url = "opening_sequences";


if ($_GET['mode'] == ""){  
  	$episode_page_name = "Opening Sequences";
	include ("header.inc");
  	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a></center>";
  	print_index($episode_name4, $episode_pages4, $url, "season4_opening");
  	print_index($episode_name5, $episode_pages5, $url, "season4_opening_hd");
  	print_index($episode_name1, $episode_pages1, $url, "Opening_Original");
  	print_index($episode_name2, $episode_pages2, $url, "TSF_opening");
  	print_index($episode_name3, $episode_pages3, $url, "TVF_Opening");
  	print_index($episode_name6, $episode_pages6, $url, "ron_factor_intro");
}else {
  if ($_GET['mode'] == "1-100"){
		 if ($_GET['ep'] == "Opening_Original"){
		   print_first_100($episode_name1, $url, $photogallery1, "101-191");
		}else if ($_GET['ep'] == "TSF_opening"){
		  print_first_100($episode_name2, $url, $photogallery2, "101-200");
		}else if ($_GET['ep'] == "TVF_Opening"){
		  print_first_100($episode_name3, $url, $photogallery3, "101-181");
		}else if ($_GET['ep'] == "season4_opening"){
		  print_first_100($episode_name4, $url, $photogallery4, "101-197");
		}else if ($_GET['ep'] == "season4_opening_hd"){
		  print_first_100($episode_name5, $url, $photogallery5, "101-158");
		}else if ($_GET['ep'] == "ron_factor_intro"){
		  print_first_100($episode_name6, $url, $photogallery6, "1-100");
		}//end if
	} else {
		if ($_GET['ep'] == "Opening_Original"){
		   print_main_pages($episode_name1, $url, $photogallery1, $episode_pages1);
		}else if ($_GET['ep'] == "TSF_opening"){
		  print_main_pages($episode_name2, $url, $photogallery2, $episode_pages2);
		}else if ($_GET['ep'] == "TVF_Opening"){
		  print_main_pages($episode_name3, $url, $photogallery3, $episode_pages3);
		}else if ($_GET['ep'] == "season4_opening"){
		  print_main_pages($episode_name4, $url, $photogallery4, $episode_pages4);
		}else if ($_GET['ep'] == "season4_opening_hd"){
		  print_main_pages($episode_name5, $url, $photogallery5, $episode_pages5);
		}else if ($_GET['ep'] == "ron_factor_intro"){
		  print_main_pages($episode_name6, $url, $photogallery6, $episode_pages6);
		}//end if
  }//end if
}//end if
include("footer.inc");

////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////PRINTS THE INDEX/////////////////////////////////
function print_index($ep, $pages, $url, $episode){
  print "<center><br /><br /><font face=\"Arial Black\" size=\"4\">Screen Caps for $ep</font><br /><table border=\"1\" style=\"border-collapse: collapse\"><tr>";
  foreach ($pages as $value){
    $counter++;
    	print "<td><a href=\"http://caps.kpfanworld.com/$url/$episode/$value\">$value</a></td>";
  }//end for
	print "</tr></table></center>";
}//end function
////////////////////////////////////////////////////////////////////////////////////////
//////////////////////PRINTS THE PAGE 1-100 FOR EACH EP/////////////////////////////////
function print_first_100($ep, $url, $photogallery, $last){
  	$episode_page_name = "".$ep." caps 1-100";
	include ("header.inc");
	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for $ep</font><br /><table border=\"0\" width=\"650\">";
	  print print_gallery("$photogallery", "1-100");
	print "</table><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for $ep</font></center>";
}//end function
////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////PRINTS THE THE MAIN PAGES OF THE EPISODES/////////////////////////////////
function print_main_pages($ep, $url, $photogallery, $pages){
	$counter = -1;
	foreach ($pages as $value){
		$counter++;
		if ($_GET['mode'] == $value){
	 		$next_page = $pages[$counter + 1];
			$last_page = $pages[$counter - 1];
			$episode_page_name = "".$ep." caps ".$value."";
			include ("header.inc");
	  		print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last_page\">Previous 100</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$next_page\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font><br /><table border=\"0\" width=\"650\">";
	  			print print_gallery("$photogallery", $value);
	  		print "</table><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last_page\">Previous 100</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$next_page\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font></center>";
		}//end if
	}//emd for
}//end function

?>