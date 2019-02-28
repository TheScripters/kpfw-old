<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******adminmessage.php*********/
include("includes/functions.php");
if ($_SESSION['UserLevel'] == "3" && isset($_REQUEST['message']))
  {
    $sql = mysql_query("INSERT INTO kpfw_admin_msg VALUES (NULL, '".$_SESSION['userID']."', '".stripslashes($_REQUEST['message'])."', '".time()."')");
    if ($_REQUEST['email'] == "True")
      {
        $msg = mysql_query("SELECT UserEmail,UserName FROM kpfw_users WHERE UserLevel = '3'");
        while($mailto = mysql_fetch_array($msg))
          {
            mail($mailto['UserEmail'], "New Admin Message Posted on KP Fan World","Dear ".$mailto['UserName'].",\n\nThis email is to notify you that ".$_SESSION['UserName']." has popsted a new admin message in the admin panel on KP Fan World.\n\nYou can view this message here: http://www.kpfanworld.com/admin.php?page=message\n\nKP Fan World.com Management",$headers);
          }
      }
    header("Location: admin.php?page=message");
  }
 else
  {
    header("Location: index.php");
  }
?>
