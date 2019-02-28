<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******addevent.php*************/
include("includes/functions.php");
if ($_SESSION['logged_in'])
  {
    $months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    $replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
    $date = explode(" ",$_REQUEST['date']);
    $month = str_replace($months,$replace,$date[0]);
    $today = mktime(0,0,0,$month,$date[1],$date[2]);
    $sql = mysql_query("INSERT INTO kpfw_today VALUES (NULL, '".$today."', '".$date[0]." ".$date[1]."', '".$date[2]."', '".$_REQUEST['event']."', '".$_SESSION['userID']."')");
    header("Location: timeline");
  }
 else
  {
    header("Location: login.php?r=timeline");
  }
?>
