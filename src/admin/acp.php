<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/meta.php*********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  $msg = mysql_fetch_array(mysql_query("SELECT Config_Value FROM kpfw_config WHERE Config_ID = 'Admin_Message'"));
  ?>
  <h2>ACP Main Message</h2><br>
  <?php
  include("admin/menu.php");
  ?>    <table align="center">
      <tr><form action="admin.php?page=acp&mode=update" method="post">
        <td align="right"><b>Admin Panel Message:</b></td>
        <td><textarea cols="50" rows="4" name="adminmsg"><?=$msg['Config_Value']?></textarea></td>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Submit">&nbsp;&nbsp;<input type="reset" value="Reset"></form></td></form>
      </tr>
    </table>
    </td>
  </tr>
</table><?php
}
elseif ($_GET['mode'] == "update"){
  $message = $_REQUEST['adminmsg'];
  $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$message."' WHERE Config_ID = 'Admin_Message'");
  header("Location: admin.php?page=acp");
}
