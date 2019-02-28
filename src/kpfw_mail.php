<?php
include("includes/functions.php");
ini_set("sendmail_from", "staff@kpfanworld.com");
$mail = mysql_query("SELECT UserId,UserName AS Name,UserEmail AS Email FROM kpfw_users");
while($mailto = mysql_fetch_array($mail))
  {
    $username = preg_replace("/ /","_",$mailto['Name']);
    mail($mailto['Email'],"KP Fan World Announcement",strip_gpc_slashes("Dear ".$mailto['Name'].",\n\nWe are pleased to announce that KP Fan World profiles are now finally active! You can edit them by logging in and clicking \"Edit Profile\" at the top.\n\nYou may access them at any of the following URLs:\nhttp://www.kpfanworld.com/profile/".$username."\nhttp://www.kpfanworld.com/profile/".$mailto['UserId']."\nhttp://www.kpfanworld.com/profile.php?user=".$mailto['UserId']."\n\nIf you have any questions, feel free to email us.\n\nKP Fan World Staff\nstaff@kpfanworld.com"),$headers);
    echo $mailto['UserId']."<br>";
  }
?>
