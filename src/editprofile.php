<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******editprofile.php**********/
include("includes/functions.php");
if (!empty($_REQUEST['newpassword']))
  {
    if ($_REQUEST['newpassword'] == $_REQUEST['vrfypassword'])
      {
        $newpass = md5($_REQUEST['newpassword']);
        $profile = addslashes($_REQUEST['profile']);
        $sql = mysql_query("UPDATE kpfw_users SET UserEmail = '".$_REQUEST['uemail']."', Time_Zone = '".$_REQUEST['timezone']."', Name = '".$_REQUEST['name']."', Profile = '".$profile."', Password = '".$newpass."' WHERE UserId = '".$_REQUEST['user']."'");
        header("Location: profile.php");
      }
     else
      {
        incheader("Edit Profile");
        echo "Passwords do not match! Please try again.<br><br><input type=\"button\" value=\"Back\" onclick=\"history.go(-1)\">";
        footer();
      }
  }
 else
  {
    $profile = addslashes($_REQUEST['profile']);
    $sql = mysql_query("UPDATE kpfw_users SET UserEmail = '".$_REQUEST['uemail']."', Time_Zone = '".$_REQUEST['timezone']."', Name = '".$_REQUEST['name']."', Profile = '".$profile."' WHERE UserId = '".$_REQUEST['user']."'");
    unset($_SESSION['TZone']);
    $_SESSION['TZone'] = $_REQUEST['timezone']*3600;
    header("Location: profile.php");
  }
?>
