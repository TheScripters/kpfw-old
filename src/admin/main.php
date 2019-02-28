<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/main.php***********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
?>
<h2>Admin Home</h2><br>
<?php
include("admin/menu.php");
$admin_main = mysql_fetch_array(mysql_query("SELECT Config_Value AS msg FROM kpfw_config WHERE Config_ID = 'Admin_Message'"));
$now = time();
$msg_cnt = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_admin_msg"));
?>
<center><?echo nl2br(bbcode($admin_main['msg']))?><br><br><b>Admin Messages:</b><br>
<?php
if ($msg_cnt['count'] == "0")
  {
    echo "No Messages at this time";
  }
 else
  {
    $date = time() - (7*24*60*60);
    echo "Total of <b>".$msg_cnt['count']."</b> message(s) exist (last 7 days shown below).<br><br>\n\n";
    $msgs = mysql_query("SELECT * FROM kpfw_admin_msg WHERE Date >= '".$date."' ORDER BY Msg_ID DESC");
    echo "<table width=\"50%\"><tr><td>";
    while($msg = mysql_fetch_array($msgs))
      {
        $userinfo = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$msg['UserID']."'"));
        $curr_user = mysql_fetch_array(mysql_query("SELECT Time_Zone FROM kpfw_users WHERE UserId = '".$_SESSION['userID']."'"));
        echo "<b>On ".gmdate("D d M Y @ g:i A",$msg['Date']+$_SESSION['TZone'])." <a href=\"mailto:".$userinfo['UserEmail']."\">".$userinfo['UserName']."</a> wrote:</b><br>";
        echo nl2br(bbcode($msg['Message']))."\n";
        echo "<br><hr size=\"2\" width=\"75%\" color=\"Lime\">";
      }
    echo "</td></tr></table>";
  }
?>
</center>
    </td>
  </tr>
</table>
