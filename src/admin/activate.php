<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/activate.php*******/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  ?>
  <h2>Activation Reminders</h2><br>
  <?php
  include("admin/menu.php");
  $act = mysql_fetch_array(mysql_query("SELECT Config_Value FROM kpfw_config WHERE Config_ID = 'ActivateSend'"));
  $time = explode(",",$act['Config_Value']);
  ?>    <center>
    <form action="admin.php?page=activate&mode=update">
    <input type="hidden" name="lastsent" value="<?=$time[1]?>">
    <input type="hidden" name="nextsend" value="<?=$time[2]?>">
    <b>Frequency in seconds:</b> <input type="text" size="7" name="freq" value="<?=$time[0]?>"> <i>86400 = 1 day = 24 hrs</i><br>
    <b>Last Sent:</b> <i><?=date("M d Y g:i:s A",$time[1])?></i><br>
    <b>Next Send:</b> <i><?=date("M d Y g:i:s A",$time[2])?></i><br>
    <input type="submit" value="Submit"></form>
    </td>
  </tr>
</table><?php
}
elseif ($_GET['mode'] == "update"){
  $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$_REQUEST['freq'].",".$_REQuEST['lastsent'].",".$_REQUEST['nextsend']."' WHERE Config_ID = 'ActivateSend'");
  header("Location: admin.php?page=activate");
}
?>
