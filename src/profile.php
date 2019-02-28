<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******profile.php**************/
include("includes/functions.php");
if (isset($_SESSION['logged_in']) && !isset($_GET['user']))
  {
    incheader("Edit Profile");
    $UserName = $_SESSION['UserName'];
    $UserID = $_SESSION['userID'];
    $Profile = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_users WHERE UserId = '".$UserID."'"));
    $checked = ($Profile['ShowEmail'] == "Yes") ? "CHECKED" : "";
    include("includes/profile_edit.inc");
    footer();
  }
if (isset($_GET['user']))
  {
    $UserView = $_REQUEST['user'];
    $Profile_View = mysql_query("SELECT * FROM kpfw_users WHERE UserId = '".$UserView."'");
    $ProfileV = mysql_fetch_array($Profile_View);
    incheader("View ".$ProfileV['UserName']."'s Profile");
    include("includes/profile_view.inc");
    footer();
  }
if (!isset($_GET['user']) || $_GET['user'] == "0")
  {
    header("Location: index.php");
  }
?>
