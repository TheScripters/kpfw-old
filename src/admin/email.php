<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/email.php**********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  ?>
  <h2>Mass Email</h2><br>
  <?php
  include("admin/menu.php");
  ?>    <center>
    <form action="admin.php?page=email&mode=send" method="post">
    <input type="checkbox" name="sendto[]" value="1" checked> Members<br>
    <input type="checkbox" name="sendto[]" value="2"> VIPs<br>
    <input type="checkbox" name="sendto[]" value="3"> Admins<br><br>
    <b>Message:</b><br>
    <textarea name="message" rows="7" cols="75"></textarea><br>
    <input type="submit" value="Send"></form>
    </td>
  </tr>
</table><?php
}
elseif ($_GET['mode'] == "send"){
  foreach ($_REQUEST['sendto'] as $level)
    {
      $sql = mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserLevel = '".$level."'");
      while($send = mysql_fetch_array($sql))
        {
          mail($send['UserEmail'],"Message from KP Fan World","Dear ".$send['UserName'].",\n\nAn administrator has sent the following message:\n\n".stripslashes($_REQUEST['message'])."\n\n---\nThank you.\nKP Fan World Staff\nstaff@kpfanworld.com",$_SESSION['headers']."X-Abuse-User-ID: ".$_SESSION['userID']."\n");
        }
    }
  header("Location: admin.php?page=email");
}
?>
