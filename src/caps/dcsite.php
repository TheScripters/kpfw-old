<?php
include ("includes/function_print_gallery.php");
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];

$episode_name1 = "Dementor's To Do List";
$episode_pages1 = array ("1-100", "101-170");
$photogallery1 = "dementor";
//////////////////////////
$episode_name2 = "Ron Stepupabble";
$episode_pages2 = array ("1-100", "101-146");
$photogallery2 = "ron";
//////////////////////////
$episode_name3 = "Priceless Coupons";
$episode_pages3 = array ("1-100", "101-109");
$photogallery3 = "coupons";
//////////////////////////
$episode_name4 = "Mad Money";
$episode_pages4 = array ("1-100");
$photogallery4 = "money";
//////////////////////////
$episode_name5 = "No Parking";
$episode_pages5 = array ("1-100", "101-108");
$photogallery5 = "parking";
//////////////////////////
$episode_name6 = "Mad Dog Mascot 101";
$episode_pages6 = array ("1-100", "101-200", "201-236");
$photogallery6 = "dog";
//////////////////////////
$episode_name7 = "About the Show";
$episode_pages7 = array ("1-100", "101-133");
$photogallery7 = "about_show";
//////////////////////////
$episode_name8 = "About Kim";
$episode_pages8 = array ("1-100", "101-183");
$photogallery8 = "aboutkim";
//////////////////////////
$episode_name9 = "About Ron";
$episode_pages9 = array ("1-100", "101-177");
$photogallery9 = "aboutron";
//////////////////////////
$episode_name10 = "About Wade";
$episode_pages10 = array ("1-100", "101-206");
$photogallery10 = "aboutwade";
//////////////////////////
$episode_name11 = "About Rufus";
$episode_pages11 = array ("1-100", "101-183");
$photogallery11 = "aboutrufus";
//////////////////////////
$episode_name12 = "About Mom";
$episode_pages12 = array ("1-100", "101-219");
$photogallery12 = "aboutmom";
//////////////////////////
$episode_name13 = "About Dad";
$episode_pages13 = array ("1-100", "101-238");
$photogallery13 = "aboutdad";
//////////////////////////
$episode_name14 = "About Jim";
$episode_pages14 = array ("1-100", "101-179");
$photogallery14 = "aboutjim";
//////////////////////////
$episode_name15 = "About Tim";
$episode_pages15 = array ("1-100", "101-205");
$photogallery15 = "abouttim";
$url = "dcsite";

if ($_GET['mode'] == ""){  
  	$episode_page_name = "Disney Web Site Promo's";
	include ("header.inc");
  	print "<center><a href=\"index.php\">Home</a></center>";
  	print_index($episode_name1, $episode_pages1, $url, "dementor");
  	print_index($episode_name2, $episode_pages2, $url, "ron");
  	print_index($episode_name3, $episode_pages3, $url, "coupons");
  	print_index($episode_name4, $episode_pages4, $url, "money");
  	print_index($episode_name5, $episode_pages5, $url, "parking");
  	print_index($episode_name6, $episode_pages6, $url, "dog");
  	print_index($episode_name7, $episode_pages7, $url, "about_show");
  	print_index($episode_name8, $episode_pages8, $url, "aboutkim");
  	print_index($episode_name9, $episode_pages9, $url, "aboutron");
  	print_index($episode_name10, $episode_pages10, $url, "aboutwade");
  	print_index($episode_name11, $episode_pages11, $url, "aboutrufus");
  	print_index($episode_name12, $episode_pages12, $url, "aboutmom");
  	print_index($episode_name13, $episode_pages13, $url, "aboutdad");
  	print_index($episode_name14, $episode_pages14, $url, "aboutjim");
  	print_index($episode_name15, $episode_pages15, $url, "abouttim");
}else {
  if ($_GET['mode'] == "1-100"){
		 if ($_GET['ep'] == "dementor"){
		   print_first_100($episode_name1, $url, $photogallery1, "101-170");
		}else if ($_GET['ep'] == "ron"){
		  print_first_100($episode_name2, $url, $photogallery2, "101-146");
		}else if ($_GET['ep'] == "coupons"){
		  print_first_100($episode_name3, $url, $photogallery3, "101-109");
		}else if ($_GET['ep'] == "money"){
		  print_first_100($episode_name4, $url, $photogallery4, "");
		}else if ($_GET['ep'] == "parking"){
		  print_first_100($episode_name5, $url, $photogallery5, "101-108");
		}else if ($_GET['ep'] == "dog"){
		  print_first_100($episode_name6, $url, $photogallery6, "101-200");
		}else if ($_GET['ep'] == "about_show"){
		  print_first_100($episode_name7, $url, $photogallery7, "101-133");
		}else if ($_GET['ep'] == "aboutkim"){
		  print_first_100($episode_name8, $url, $photogallery8, "101-183");
		}else if ($_GET['ep'] == "aboutron"){
		  print_first_100($episode_name9, $url, $photogallery9, "101-177");
		}else if ($_GET['ep'] == "aboutwade"){
		  print_first_100($episode_name10, $url, $photogallery10, "101-206");
		}else if ($_GET['ep'] == "aboutrufus"){
		  print_first_100($episode_name11, $url, $photogallery11, "101-183");
		}else if ($_GET['ep'] == "aboutmom"){
		  print_first_100($episode_name12, $url, $photogallery12, "101-219");
		}else if ($_GET['ep'] == "aboutdad"){
		  print_first_100($episode_name13, $url, $photogallery13, "101-238");
		}else if ($_GET['ep'] == "aboutjim"){
		  print_first_100($episode_name14, $url, $photogallery14, "101-179");
		}else if ($_GET['ep'] == "abouttim"){
		  print_first_100($episode_name15, $url, $photogallery15, "101-205");
		}//end if
	} else {
	if ($_GET['ep'] == "dementor"){
		   print_main_pages($episode_name1, $url, $photogallery1, $episode_pages1);
		}else if ($_GET['ep'] == "ron"){
		  print_main_pages($episode_name2, $url, $photogallery2, $episode_pages2);
		}else if ($_GET['ep'] == "coupons"){
		  print_main_pages($episode_name3, $url, $photogallery3, $episode_pages3);
		}else if ($_GET['ep'] == "money"){
		  print_main_pages($episode_name4, $url, $photogallery4, $episode_pages4);
		}else if ($_GET['ep'] == "parking"){
		  print_main_pages($episode_name5, $url, $photogallery5, $episode_pages5);
		}else if ($_GET['ep'] == "dog"){
		  print_main_pages($episode_name6, $url, $photogallery6, $episode_pages6);
		}else if ($_GET['ep'] == "about_show"){
		  print_main_pages($episode_name7, $url, $photogallery7, $episode_pages7);
		}else if ($_GET['ep'] == "aboutkim"){
		  print_main_pages($episode_name8, $url, $photogallery8, $episode_pages8);
		}else if ($_GET['ep'] == "aboutron"){
		  print_main_pages($episode_name9, $url, $photogallery9, $episode_pages9);
		}else if ($_GET['ep'] == "aboutwade"){
		  print_main_pages($episode_name10, $url, $photogallery10, $episode_pages10);
		}else if ($_GET['ep'] == "aboutrufus"){
		  print_main_pages($episode_name11, $url, $photogallery11, $episode_pages11);
		}else if ($_GET['ep'] == "aboutmom"){
		  print_main_pages($episode_name12, $url, $photogallery12, $episode_pages12);
		}else if ($_GET['ep'] == "aboutdad"){
		  print_main_pages($episode_name13, $url, $photogallery13, $episode_pages13);
		}else if ($_GET['ep'] == "aboutjim"){
		  print_main_pages($episode_name14, $url, $photogallery14, $episode_pages14);
		}else if ($_GET['ep'] == "abouttim"){
		  print_main_pages($episode_name15, $url, $photogallery15, $episode_pages15);
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
    	print "<td><a href=\"$url.php?mode=$value&amp;ep=$episode\">$value</a></td>";
  }//end for
	print "</tr></table></center>";
}//end function
////////////////////////////////////////////////////////////////////////////////////////
//////////////////////PRINTS THE PAGE 1-100 FOR EACH EP/////////////////////////////////
function print_first_100($ep, $url, $photogallery, $last){
  	$episode_page_name = "".$ep." caps 1-100";
	include ("header.inc");
	print "<center><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php?mode=$last&amp;ep=".$_GET['ep']."\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for $ep</font><br /><table border=\"0\" width=\"650\">";
	  print print_gallery("$photogallery", "1-100");
	print "</table><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php?mode=$last&amp;ep=".$_GET['ep']."\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for $ep</font></center>";
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
	  		print "<center><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php?mode=$last_page&amp;ep=".$_GET['ep']."\">Previous 100</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php?mode=$next_page&amp;ep=".$_GET['ep']."\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font><br /><table border=\"0\" width=\"650\">";
	  			print print_gallery("$photogallery", $value);
	  		print "</table><a href=\"index.php\">Home</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php\">Episode Index</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php?mode=$last_page&amp;ep=".$_GET['ep']."\">Previous 100</a>&nbsp;&nbsp;&nbsp; <a href=\"$url.php?mode=$next_page&amp;ep=".$_GET['ep']."\">Next 100</a><br /><font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $ep</font></center>";
		}//end if
	}//emd for
}//end function

?>