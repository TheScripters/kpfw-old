<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******user_ban.php*************/
session_start();
$today = time();
if ($_SESSION['logged_in'] == "True")
  {
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS bans FROM kpfw_user_bans WHERE UserID = '".$_SESSION['userID']."'"));
    if ($count['bans'] == "1")
      {
        unset($_SESSION);
        session_destroy();
        echo "<html>\n<head>\n<meta http-equiv=\"refresh\" content=\"10;url='http://www.kpfanworld.com/login.php?mode=logout'\">\n<title>Kim Possible Fan World .:::. Error</title>\n<base href=\"http://www.kpfanworld.com/\">\n";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n";
        echo "</head>\n\n<body><br><center><img src=\"images/kpfwlogo.jpg\"><br><br><font color=\"#FFFF00\" size=\"4\"><b>You do not currently have permission to view this site.<br>If you feel this in error, please contact the management at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>.<br><br>Thank You.</b><br><br><br>You have been signed out at this time...</center>\n</body>\n</html>";
        exit;
      }
  }
$NewDate = mysql_query("SELECT Effective_Until AS Effect,UserId FROM kpfw_user_bans");
while($date = mysql_fetch_array($NewDate))
 {
   if ($today >= $date['Effect'] && $date['Effect'] != "0")
     {
       $unban = mysql_query("DELETE FROM kpfw_user_bans WHERE UserID = '".$date['UserId']."'");
       $email = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$date['UserId']."'"));
       mail("".$email['UserName']." <".$email['UserEmail'].">","Account Unbanned","Dear ".$email['UserName'].",\n\nYour account on Kim Possible FanWorld has been unbanned and you may now log back in. Sorry for any inconvenience.\n\nThank you\nManagement,\nKim Possible FanWorld","From: webmaster@kpfanworld.com");
     }
   }
?>
