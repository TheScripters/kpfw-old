<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/userbans.php*******/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  ?>
  <h2>User Banning</h2><br>
  <?php
  include("admin/menu.php");
  ?>  <center>
    <br><form action="admin.php?page=userbans&mode=remove" method="post">
    <h3>Unban User</h3>
    <select name="username[]" size="6" multiple>
    <?php
    $banlist = mysql_query("SELECT UserID FROM kpfw_user_bans");
    while($userlist = mysql_fetch_array($banlist))
      {
        $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$userlist['UserID']."'"));
        echo "    <option name=\"username\" value=\"".$userlist['UserID']."\">".$user['UserName']."</option>\n";
      }
    ?>
    </select><br>
    <input type="submit" value="Submit"></form>
    <br><br>
    <form action="admin.php?page=userbans&mode=add" method="post">
    <h3>Ban User</h3>
    <b>User Name:</b> <input type="text" name="username" size="30"><br>
    <b>Length of time:</b> <input type="text" name="time" size="5" maxlength="2">&nbsp;&nbsp;
    <select name="unit"><option name="unit" value="604800">Week(s)</option><option name="unit" value="86400">Day(s)</option><option name="unit" value="3600">Hour(s)</option></select><br>
    Enter "0" to ban forever.<br><br>
    <input type="submit" value="Submit"></form>
    </td>
  </tr>
</table>
    <?php
}
elseif ($_GET['mode'] == "remove"){
  foreach($_REQUEST['username'] as $user){
    $userinfo = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$user."'"));
    $sql = mysql_query("DELETE FROM kpfw_user_bans WHERE UserID = '".$user."'");
    mail($userinfo['UserEmail'],"Account Unsuspended","Dear ".$userinfo['UserName'].",\n\nYour account on Kim Possible FanWorld has been unsuspended and you may now log back in. Sorry for any inconvenience.\n\nThank you\nManagement,\nKim Possible FanWorld",$_SESSION['headers']);
  }
  header("Location: admin.php?page=userbans");
}
elseif ($_GET['mode'] == "add"){
  $username = mysql_fetch_array(mysql_query("SELECT UserId,UserName,UserEmail FROM kpfw_users WHERE UserName = '".$_REQUEST['username']."'"));
  $now = time();
  $unit1 = array('604800','86400','3600');
  $unit2 = array('week(s)','day(s)','hour(s)');
  $unit = str_replace($unit1,$unit2,$_REQUEST['unit']);
  $until = ($_REQUEST['time'] >= "1") ? time()+($_REQUEST['time']*$_REQUEST['unit']) : "0";
  $sql = mysql_query("INSERT INTO kpfw_user_bans VALUES ('".$username['UserId']."', '".$now."', '".$until."')");
  $effective = ($until != "0") ? date("d M Y g:i A",$until) : "further notice";
  mail($username['UserEmail'],"Account Suspension Notice","Dear ".$username['UserName'].",\n\nWe are sorry to inform you that your account on KP Fan World has been suspended for a duration of ".$_REQUEST['time']." ".$unit." until $effective server time.\n\nIf you wish to plead your case or if you don't know why this has happened, you may email us at staff@kpfanworld.com.\n\nAn administrator should contact you shortly about this matter.\n\nThank you,\nKP Fan World Staff",$_SESSION['headers']);
  header("Location: admin.php?page=userbans");
}
?>
