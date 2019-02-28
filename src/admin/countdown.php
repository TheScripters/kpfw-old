<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/countdown.php*****/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  $times = mysql_fetch_array(mysql_query("SELECT Config_Value AS times FROM kpfw_config WHERE Config_ID = 'countdown_time'"));
  $text = mysql_fetch_array(mysql_query("SELECT Config_Value AS text FROM kpfw_config WHERE Config_ID = 'countdown_text'"));
  $count_act = mysql_fetch_array(mysql_query("SELECT Config_Value as active FROM kpfw_config WHERE Config_ID = 'countdown_active'"));
  $active = ($count_act['active'] == "True") ? " CHECKED": "";
  $times = explode(";",$times['times']);
  $time_est = explode(",",$times[0]);
  $time_pst = explode(",",$times[1]);
  $text = explode(";",$text['text']);
  ?>
  <h2>Countdown Configuration</h2><br>
  <?php
  include "admin/menu.php";
  ?>      <center><font size="+2"><b>Server timezone: <?=date("T O e")?></b></font><br>Set accordingly!<br>
      <form action="admin.php?page=countdown&mode=submit" method="post">
      <b>PST Time:</b> <input type="text" size="3" maxlength="2" name="hr_p" value="<?=$time_pst[0]?>"> : <input type="text" size="3" maxlength="2" name="min_p" value="<?=$time_pst[1]?>"> : <input type="text" size="3" maxlength="2" name="sec_p" value="<?=$time_pst[2]?>"><br>
      <b>Date:</b> <input type="text" size="3" maxlength="2" name="mo_p" value="<?=$time_pst[3]?>"> <input type="text" size="3" maxlength="2" name="day_p" value="<?=$time_pst[4]?>">, <input type="text" size="3" maxlength="4" name="yr_p" value="<?=$time_pst[5]?>"><br><br>
      <b>EST Time:</b> <input type="text" size="3" maxlength="2" name="hr_e" value="<?=$time_est[0]?>"> : <input type="text" size="3" maxlength="2" name="min_e" value="<?=$time_est[1]?>"> : <input type="text" size="3" maxlength="2" name="sec_e" value="<?=$time_est[2]?>"><br>
      <b>Date:</b> <input type="text" size="3" maxlength="2" name="mo_e" value="<?=$time_est[3]?>"> <input type="text" size="3" maxlength="2" name="day_e" value="<?=$time_est[4]?>">, <input type="text" size="3" maxlength="4" name="yr_e" value="<?=$time_est[5]?>"><br><br>
      <b>Countdown Visible:</b> <input type="checkbox" name="active" value="True"<?=$active?>><br>
      <b>Length of event in Seconds:</b> <input type="text" size="6" maxlength="7" name="length" value="<?=$times[3]?>"><br>
      <b>Sensitivity:</b> <input type="text" size="4" maxlength="3" name="sens" value="<?=$times[2]?>"> (hr, min, sec)<br><br>
      <b>Time Left Text:</b><br><textarea name="left" rows="3" cols="45"><?=$text[0]?></textarea><br><br>
      <b>Event Active Text:</b><br><textarea name="expire" rows="3" cols="45"><?=$text[1]?></textarea><br><br>
      <b>Event Over Text:</b><br><textarea name="expired" rows="3" cols="45"><?=$text[2]?></textarea><br><br>
      <input type="submit" value="Update"></form>
      </center>
    </td>
  </tr>
</table>
  <?php
} elseif ($_GET['mode'] == "submit"){
  $time_pst = $_REQUEST['hr_p'].",".$_REQUEST['min_p'].",".$_REQUEST['sec_p'].",".$_REQUEST['mo_p'].",".$_REQUEST['day_p'].",".$_REQUEST['yr_p'];
  $time_est = $_REQUEST['hr_e'].",".$_REQUEST['min_e'].",".$_REQUEST['sec_e'].",".$_REQUEST['mo_e'].",".$_REQUEST['day_e'].",".$_REQUEST['yr_e'];
  $time_compile = $time_est.";".$time_pst.";".$_REQUEST['sens'].";".$_REQUEST['length'];
  $text = $_REQUEST['left'].";".$_REQUEST['expire'].";".$_REQUEST['expired'];
  $active = ($_REQUEST['active'] == "True") ? "True" : "False";
  $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$time_compile."' WHERE Config_ID = 'countdown_time'");
  $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$text."' WHERE Config_ID = 'countdown_text'");
  $sql = mysql_query("UPDATE kpfw_config SET COnfig_Value = '".$active."' WHERE Config_ID = 'countdown_active'");
  header("Location: admin.php?page=countdown");
}