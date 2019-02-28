<?php

error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$counter = $_REQUEST['counter'];
$episode_name = "Graduation";
$episode_pages = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1170");
$episode_pages2 = array ("1-100", "101-200", "201-300", "301-400", "401-500", "501-600", "601-700", "701-800", "801-900", "901-1000", "1001-1100", "1101-1121");
$url = "graduation";

if ($_GET['mode'] == ""){  
  print_index($episode_name, $episode_pages, $episode_pages2, $url);
}else {
  if ($_GET['v']=="1"){
	  if ($_GET['mode'] == "1-100"){
			 print_1_100($episode_name, $url, "graduation1", "1");
	  } else {
			print_main_pages($episode_name, $episode_pages, $url, "graduation1", "1");
	  }//end if
  }else{
		if ($_GET['mode'] == "1-100"){
			 print_1_100($episode_name, $url, "graduation2", "2");
		} else {
			print_main_pages($episode_name, $episode_pages2, $url, "graduation2", "2");
	   }//end if
  }//end if
}//end if
include("footer.inc");


function print_index ($episode_name, $episode_pages, $episode_pages2, $url){
  	$episode_page_name = $episode_name;
	include("header.inc");
	print"<center>
	<a href=\"http://caps.kpfanworld.com/index.php\">Home</a><br /><br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps for the episode Graduation Part 1</font>
	<br />
	<table border=\"1\"><tr>";
	  foreach ($episode_pages as $value){
	    	print "<td><a href=\"http://caps.kpfanworld.com/$url/1/$value\">$value</a></td>";
	  }//end for
	print "</tr></table><br /><br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps for the episode Graduation Part 2</font>
	<br />
	<table border=\"1\"><tr>";
	  foreach ($episode_pages2 as $value){
	    	print "<td><a href=\"http://caps.kpfanworld.com/$url/2/$value\">$value</a></td>";
	  }//end for
	print "</tr></table></center>";
}


function print_1_100($episode_name, $url, $photogallery, $page){
	include ("includes/function_print_gallery.php");
	$episode_page_name = "".$episode_name." caps 1-100";
	include("header.inc");
	 print "<center>
	<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/$page/101-200\">Next 100</a><br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $episode_name part $page</font><br />
	<table border=\"0\" width=\"650\">";
	print print_gallery("$photogallery", "1-100");
	print "
	</table>
	<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/$page/101-200\">Next 100</a><br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps 1-100 for the episode $episode_name part $page</font></center>";
}

function print_main_pages($episode_name, $episode_pages, $url, $photogallery, $page){
	include ("includes/function_print_gallery.php");
	$counter = -1;
	foreach ($episode_pages as $value){
		$counter++;
		if ($_GET['mode'] == $value){
		  $episode_page_name = "".$episode_name." caps ".$_GET['mode']."";
			include("header.inc");
		  $next_page = $episode_pages[$counter + 1];
		  $last_page = $episode_pages[$counter - 1];
		  print "<center>
	<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/$page/$last_page\">Previous 100</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/$page/$next_page\">Next 100</a><br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $episode_name part $page</font><br />
	<table border=\"0\" width=\"650\">";
		  		print print_gallery("$photogallery", $value);
		  print "
	</table>
	<a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url\">Episode Index</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/$page/$last_page\">Previous 100</a>&nbsp;&nbsp;&nbsp; 
	<a href=\"http://caps.kpfanworld.com/$url/$page/$next_page\">Next 100</a><br />
	<font face=\"Arial Black\" size=\"4\">Screen Caps $value for the episode $episode_name part $page</font></center>";
		}//end if
	}//emd for
}
?>