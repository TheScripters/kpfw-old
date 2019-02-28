<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/promote.php********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_REQUEST['user'] && !$_GET['mode'])
  {
    echo "<h2>User Levels</h2><br>\n";
    include("admin/menu.php");
    echo "<center><br><form action=\"admin.php?page=promote\" method=\"post\">\n";
    echo "<b>User Name:</b> <input type=\"text\" name=\"user\"><br>\n";
    echo "<input type=\"submit\" value=\"Edit\"></form>\n";
  }
if ($_REQUEST['user'] && !$_GET['mode'])
  {
    $userid = mysql_fetch_array(mysql_query("SELECT UserId,UserName,UserLevel FROM kpfw_users WHERE UserName = '".$_REQUEST['user']."'"));
    if ($userid['UserLevel'] == "1") {$level = "Member";}
    if ($userid['UserLevel'] == "2") {$level = "VIP";}
    if ($userid['UserLevel'] == "3") {$level = "Administrator";}
    ?>
    <h2>Update Level of <?=$userid['UserName']?></h2><br>
    <?include("admin/menu.php");?><center>
    <form action="admin.php?page=promote&mode=edit" method="post">
    <input type="hidden" name="userid" value="<?=$userid['UserId']?>">
    <b>Current:</b> <i><?=$level?></i><br>
    <b>Level:</b> <select name="level"><option name="level" value="3">Administrator</option>
    <option name="level" value="2">VIP</option><option name="level" value="1">Member</option><option name="level" value="4">Developer</option></select>
    <br><input type="submit" value="Submit"></form>
    <?php
  }
if ($_GET['mode'] == "edit")
  {
    $currlvl = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail,UserLevel FROM kpfw_users WHERE UserId = '".$_REQUEST['userid']."'"));
    if ($currlvl['UserLevel'] == "1") {$old = "Member";}
    if ($currlvl['UserLevel'] == "2") {$old = "VIP";}
    if ($currlvl['UserLevel'] == "3") {$old = "Administrator";}
    if ($currlvl['UserLevel'] == "4") {$old = "Developer";}
    $moted = ($currlvl['UserLevel'] < $_REQUEST['level']) ? "promoted" : "demoted";
    if ($_REQUEST['level'] == "1") {$new = "Member";}
    if ($_REQUEST['level'] == "2") {$new = "VIP";}
    if ($_REQUEST['level'] == "3") {$new = "Administrator";}
    if ($_REQUEST['level'] == "4") {$new = "Developer";}
    if ($currlvl['UserLevel'] == $_REQUEST['level'])
      {
        header("Location: admin.php?page=promote");
      }
     else
      {
        $sql = mysql_query("UPDATE kpfw_users SET UserLevel = '".$_REQUEST['level']."' WHERE UserId = '".$_REQUEST['userid']."'");
        mail($currlvl['UserEmail'],"Account $moted on KP Fan World","Dear ".$currlvl['UserName'].",\n\nThis email is to inform you that your account has been $moted from $old to $new.\n\nIf you feel this in error, or wish for an explanation or have questions, feel free to email us at staff@kpfanworld.com.\n\nThank you.\nKP Fan World Staff","Reply-to: staff@kpfanworld.com\nFrom: staff@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
        header("Location: admin.php?page=promote");
      }
  }
?>
</center>
    </td>
  </tr>
</table>
