<?php
// Code © 2006 KPFanWorld.com
// Code witten by Adam Humpherys
/*******admin/message.php*******/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
?>
<h2>Message Area</h2><br>
<?php
include("admin/menu.php");
echo "<center>";
$msg_cnt = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_admin_msg"));
if ($msg_cnt['count'] == "0")
  {
    echo "No Messages at this time";
  }
 else
  {
    echo "Total of <b>".$msg_cnt['count']."</b> message(s) exist (last 10 shown below).<br><br>\n\n";
    $msgs = mysql_query("SELECT * FROM kpfw_admin_msg ORDER BY Msg_ID DESC LIMIT 0,10");
    echo "<table align=\"center\" width=\"50%\"><tr><td>";
    while($msg = mysql_fetch_array($msgs))
      {
        $userinfo = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$msg['UserID']."'"));
        $curr_user = mysql_fetch_array(mysql_query("SELECT Time_Zone FROM kpfw_users WHERE UserId = '".$_SESSION['userID']."'"));
        echo "<b>On ".gmdate("D d M Y @ g:i A",$msg['Date']+$_SESSION['TZone'])." <a href=\"mailto:".$userinfo['UserEmail']."\">".$userinfo['UserName']."</a> wrote:</b><br>";
        echo nl2br(bbcode($msg['Message']))."\n";
        echo "<br><hr size=\"2\" width=\"75%\" color=\"Lime\">";
      }
    echo "</td></tr></table>\n";
  }
?>
      <form action="admin.php?page=message&mode=add" method="post">
      <b>Message:</b><br><textarea name="message" cols="60" rows="6"></textarea><br>
      <input type="checkbox" value="True" name="email"> Email other administrators?<br>
      <input type="submit" value="Submit"></form></center>
    </td>
  </tr>
</table>
<?php
}
if ($_GET['mode'] == "add")
  {
    $sql = mysql_query("INSERT INTO kpfw_admin_msg VALUES (NULL, '".$_SESSION['userID']."', '".$_REQUEST['message']."', '".time()."')");
    if ($_REQUEST['email'] == "True")
      {
        $msg = mysql_query("SELECT UserEmail,UserName FROM kpfw_users WHERE UserLevel = '3'");
        while($mailto = mysql_fetch_array($msg))
          {
            mail($mailto['UserEmail'], "New Admin Message Posted on KP Fan World","Dear ".$mailto['UserName'].",\n\nThis email is to notify you that ".$_SESSION['UserName']." has popsted a new admin message in the admin panel on KP Fan World.\n\nYou can view this message here: http://www.kpfanworld.com/admin.php?page=message\n\nKP Fan World.com Management",$_SESSION['headers']);
          }
      }
    header("Location: admin.php?page=message");
  }
?>
