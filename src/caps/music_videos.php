<?php
include ("includes/function_print_gallery.php");
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name1 = "Get Your Shine On";
$episode_pages1 = array ("1-100", "101-188");
$photogallery1 = "gyso";
//////////////////////////
$episode_name2 = "It's Just You";
$episode_pages2 = array ("1-100", "101-200", "201-349");
$photogallery2 = "ItsJustYou";
//////////////////////////
$episode_name3 = "Naked Mole Rat Rap";
$episode_pages3 = array ("1-100", "101-237");
$photogallery3 = "nmr";
//////////////////////////
$episode_name4 = "Say The Word";
$episode_pages4 = array ("1-100", "101-200", "201-329");
$photogallery4 = "STW";
//////////////////////////
$episode_name5 = "Could It Be";
$episode_pages5 = array ("1-100", "101-200", "201-247");
$photogallery5 = "cib";
$url = "music_videos";


if ($_GET['mode'] == ""){  
  	$episode_page_name = "Music Videos";
	include("header.inc");
  	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a></center>";
  	print_index($episode_name1, $episode_pages1, $url, "gyso");
  	print_index($episode_name2, $episode_pages2, $url, "ItsJustYou");
  	print_index($episode_name3, $episode_pages3, $url, "nmr");
  	print_index($episode_name4, $episode_pages4, $url, "STW");
  	print_index($episode_name5, $episode_pages5, $url, "cib");
}else {
  if ($_GET['mode'] == "1-100"){
		 if ($_GET['ep'] == "gyso"){
		   print_first_100($episode_name1, $url, $photogallery1, "101-188");
		}else if ($_GET['ep'] == "ItsJustYou"){
		  print_first_100($episode_name2, $url, $photogallery2, "101-200");
		}else if ($_GET['ep'] == "nmr"){
		  print_first_100($episode_name3, $url, $photogallery3, "101-237");
		}else if ($_GET['ep'] == "STW"){
		  print_first_100($episode_name4, $url, $photogallery4, "101-200");
		}else if ($_GET['ep'] == "cib"){
		  print_first_100($episode_name5, $url, $photogallery5, "101-200");
		}//end if
	} else {
	if ($_GET['ep'] == "gyso"){
		   print_main_pages($episode_name1, $url, $photogallery1, $episode_pages1);
		}else if ($_GET['ep'] == "ItsJustYou"){
		  print_main_pages($episode_name2, $url, $photogallery2, $episode_pages2);
		}else if ($_GET['ep'] == "nmr"){
		  print_main_pages($episode_name3, $url, $photogallery3, $episode_pages3);
		}else if ($_GET['ep'] == "STW"){
		  print_main_pages($episode_name4, $url, $photogallery4, $episode_pages4);
		}else if ($_GET['ep'] == "cib"){
		  print_main_pages($episode_name5, $url, $photogallery5, $episode_pages5);
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
	print "</tr></table></center>";
}//end function
////////////////////////////////////////////////////////////////////////////////////////
//////////////////////PRINTS THE PAGE 1-100 FOR EACH EP/////////////////////////////////
function print_first_100($ep, $url, $photogallery, $last){
  	$episode_page_name = "".$ep." caps 1-100";
	include("header.inc");
	print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $ep</font><br /><table border=\"0\" width=\"650\">";
	print print_gallery("$photogallery", "1-100");
	print "</table><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $ep</font></center>";
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
			include("header.inc");
	  		print "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last_page\">Previous 100</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$next_page\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font><br /><table border=\"0\" width=\"650\">";
	  		print print_gallery("$photogallery", $value);
	  		print "</table><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$last_page\">Previous 100</a>&nbsp;&nbsp;&nbsp; <a href=\"http://caps.kpfanworld.com/$url/".$_GET['ep']."/$next_page\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font></center>";
		}//end if
	}//emd for
}//end function
?>