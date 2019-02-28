<?php
if ($_GET['mode'] == "66"){
  redirect("Ill-Suited", "ill-suited.php");
} else if ($_GET['mode'] == "67"){
  redirect("The Big Job", "the_big_job.php");	
} else if ($_GET['mode'] == "68"){
  redirect("Trading Faces", "trading_faces.php");		
} else if ($_GET['mode'] == "69"){
  redirect("The Cupid Effect", "the_cupid_effect.php");	
} else if ($_GET['mode'] == "70"){
  redirect("Car Alarm", "car_alarm.php");
} else if ($_GET['mode'] == "71"){
  redirect("Mad Dogs and Aliens", "mad_dogs_and_aliens.php");	
} else if ($_GET['mode'] == "72"){
  redirect("Grande Size Me", "grande_size_me.php");
} else if ($_GET['mode'] == "73"){
  redirect("Clothes Minded", "clothes_minded.php");
} else if ($_GET['mode'] == "74"){
  redirect("Big Bother", "big_bother.php");
} else if ($_GET['mode'] == "75"){
  redirect("Fashion Victim", "fashion_victim.php");
} else if ($_GET['mode'] == "76"){
  redirect("Odds Man In", "odds_man_in.php");
} else if ($_GET['mode'] == "77"){
  redirect("Stop Team Go", "stop_team_go.php");
} else if ($_GET['mode'] == "78"){
  redirect("Cap'n Drakken", "capn_drakken.php");
} else if ($_GET['mode'] == "79"){
  redirect("Mathter and Fervant", "mathter_and_fervent.php");
} else if ($_GET['mode'] == "80"){
  redirect("Mentor of Our Discontent", "mentor_of_our_discontent.php");
} else if ($_GET['mode'] == "81"){
  redirect("Oh No! Yono", "oh_no_yono.php");
} else if ($_GET['mode'] == "82"){
  redirect("Clean Slate", "clean_slate.php");
} else if ($_GET['mode'] == "83"){
  redirect("Homecoming Upset", "homecoming_upset.php");
} else if ($_GET['mode'] == "84"){
  printpage("Chasing Rufus/Nursery Crimes", 18, 30, 0, 8, 12, 2007);
} else if ($_GET['mode'] == "85"){
  redirect("Larry's Birthday", "larrys_birthday.php");
} else if ($_GET['mode'] == "86"){
  printpage("Graduation Part 1", 18, 0, 0, 9, 7, 2007);
} else if ($_GET['mode'] == "87"){
  printpage("Graduation Part 2", 18, 30, 0, 9, 7, 2007);
}//end if

function printpage($ep, $hour, $min, $sec, $month, $day, $year){
  $hour2 = $hour + 3;
  	$episode_page_name = $ep;
	include("header_season4.inc");
	include("includes/countdown.php");
	print "<center><a href=\"index.php\">Home</a><br><br>";
	print countdown($hour,$min,$sec,$month,$day,$year,"sec","<font color=\"#00FF00\"><b>$ep will air in <font color=\"#FFFF00\">%time%</font> EST","<font color=\"#00FF00\"><b>$ep has started",-1800,"<font color=\"#00FF00\"><b>$ep is Over, Please Wait Until The Screen Caps Have Been Uploaded");
	print "! <br></b></font>";
	print countdown($hour2,$min,$sec,$month,$day,$year,"sec","<font color=\"#00FF00\"><b>$ep will air in <font color=\"#FFFF00\">%time%</font> PST","<font color=\"#00FF00\"><b>$ep has started",-1800,"<font color=\"#00FF00\"><b>$ep is Over, Please Wait Until The Screen Caps Have Been Uploaded");
	print "!<br> Please Come Back Later</b></font></center>";
}//end function

function redirect($ep, $url){
print"
<html>
	<head>
		<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5; URL=http://caps.kpfanworld.com/$url\">
	</head>
	<body link=\"#FFFF00\" vlink=\"#FF0000\" alink=\"#FF0000\" text=\"#00FF00\" bgcolor=\"#000000\">
		<center>
			<h1>This page will redirect automatically.<br>$ep has now been uploaded to a different location
			<br><br>
			<a href=\"http://caps.kpfanworld.com/$url\">Click here</a> if you do not wish to wait.
			</h1>
		</center>
	</body>
</html>";
}//end function
include("footer.inc");
?>