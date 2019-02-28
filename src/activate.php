<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******activate.php*************/
session_start();
$UserId = $_REQUEST['user'];
$Act_Key = $_REQUEST['code'];
include("includes/functions.php");
$Actsql = mysql_query("SELECT Act_Key, UserName FROM kpfw_users WHERE UserId = '$UserId'");
$ActKey = mysql_fetch_array($Actsql);
if ($Act_Key == $ActKey['Act_Key'])
  {
    $_SESSION['logged_in'] = "True";
    $_SESSION['userID'] = $UserId;
    $_SESSION['UserName'] = $ActKey['UserName'];
    $sql = mysql_query("UPDATE kpfw_users SET Active = '1', Act_Key = '', IP_Login = '".$_SERVER['REMOTE_ADDR']."' WHERE UserId = '$UserId'");
    header("Location: index.php");
  }
 else
  {
    incheader("User Activation");
    echo "Activation key is invalid! Please contact an administrator for assistance at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>.<br><br>Thank you.";
    footer();
  }
?>
