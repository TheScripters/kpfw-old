<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******editevent.php************/
include("includes/functions.php");
if ($_SESSION['logged_in'] && !$_GET['mode'] && $_GET['id'])
  {
    incheader("Edit Event");
    echo "<br><table width=\"50%\" align=\"center\"><tr><td align=\"center\">\n";
    $event = mysql_fetch_array(mysql_query("SELECT Month_Day,Year,News_Text FROM kpfw_today WHERE News_ID = '".$_GET['id']."'"));
    echo "<form action=\"editevent.php?mode=edit\" method=\"post\">\n";
    echo "<b>Date:</b> <input type=\"text\" value=\"".$event['Month_Day']." ".$event['Year']."\" name=\"date\"><br>\n";
    echo "<b>Event</b><br><textarea rows=\"3\" cols=\"50\" name=\"event\">".stripslashes($event['News_Text'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"News_ID\" value=\"".$_GET['id']."\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form>\n</td></tr></table><br><br>\n";
    footer();
  }
 elseif ($_SESSION['logged_in'] && $_GET['mode'] && !$_GET['id'])
  {
    $months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    $replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
    $date = explode(" ",$_REQUEST['date']);
    $month = str_replace($months,$replace,$date[0]);
    $today = mktime(0,0,0,$month,$date[1],$date[2]);
    $sql = mysql_query("UPDATE kpfw_today SET Month_Day = '".$date[0]." ".$date[1]."', Year = '".$date[2]."', News_Text = '".$_REQUEST['event']."', Date = '".$today."', UserID = '".$_SESSION['userID']."' WHERE News_ID = '".$_REQUEST['News_ID']."'");
    header("Location: timeline");
  }
 elseif (!$_SESSION['logged_in'])
  {
    header("Location: login.php?r=timeline");
  }
?>
