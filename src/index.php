<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******index.php****************/
include("includes/functions.php");
incheader("Home");

$newsactive = mysql_fetch_array(mysql_query("SELECT Config_Value as active FROM kpfw_config WHERE Config_ID = 'Index_News_Active'"));
$count_act = mysql_fetch_array(mysql_query("SELECT Config_Value as active FROM kpfw_config WHERE Config_ID = 'countdown_active'"));
?><br>
<?php
if ($count_act['active'] == "True"){
  $times = mysql_fetch_array(mysql_query("SELECT Config_Value AS times FROM kpfw_config WHERE Config_ID = 'countdown_time'"));
  $text = mysql_fetch_array(mysql_query("SELECT Config_Value AS text FROM kpfw_config WHERE Config_ID = 'countdown_text'"));
  $times = explode(";",$times['times']);
  $time_est = explode(",",$times[0]);
  $time_pst = explode(",",$times[1]);
  $text = explode(";",$text['text']);
  echo countdown($time_est[0],$time_est[1],$time_est[2],$time_est[3],$time_est[4],$time_est[5],$times[2],$text[0],$text[1],$times[3],$text[2])." EST!</b></font><br>\n";
  echo countdown($time_pst[0],$time_pst[1],$time_pst[2],$time_pst[3],$time_pst[4],$time_pst[5],$times[2],$text[0],$text[1],$times[3],$text[2])." PST!</b></font><br>\n";
}
if ($newsactive['active'] == "True")
  {
    $news = mysql_fetch_array(mysql_query("SELECT Config_Value as news FROM kpfw_config WHERE Config_ID = 'Index_News'"));
    echo "<br><font size=\"+1\" color=\"#00FF00\">".stripslashes(nl2br($news['news']))."</font><br>\n";
  }
$today = gmdate("M d", time()+$_SESSION['TZone']);
$hist_count = mysql_query("SELECT COUNT(*) AS count FROM kpfw_today WHERE Month_Day = '$today'");
$histCount = mysql_fetch_array($hist_count);
echo "<br><b>This day in KP History:</b><br>";
if ($histCount['count'] == "0")
  {
    echo "There are no KP events today.<br>";
  }
if ($histCount['count'] >= "1")
  {
    $history = mysql_query("SELECT Month_Day,Year,News_Text FROM kpfw_today WHERE Month_Day = '$today'");
    while($histRow = mysql_fetch_array($history))
      {
        echo "<b>".$histRow['Month_Day'].", ".$histRow['Year']."</b> -- ";
        echo $histRow['News_Text']."<br>";
      }
  }

?>
<br><input type="button" onclick="window.open('suggest.html','','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=no,width=493,height=385');" value="Send Feedback"><br><br>

<table border="1" rules="none" align="center">
  <tr>
    <td align="center"><i>Oh Yeaaahh Yeah<br><br>
    I'm your basic average girl and I'm here to save the world<br>
    You can't stop me 'cause I'm Kim-Poss-i-ble<br><br>
    There is nothin' I can't do<br>
    When danger comes just know that I am on my way<br><br>
    Doesn't matter where or when there's trouble,<br>
    if you just call my name "Kim Possible"<br><br>
    Call me, beep me if you wanna reach me<br>
    When you wanna page me, it's okay<br>
    Whenever you need me baby,<br>
    Call me, beep me if you wanna reach me<br><br>
    *Call me, beep me if you wanna reach me*<br><br>
    Doesn't matter where, doesn't matter when<br>
    I will be there with you 'till the very end<br>
    Danger or trouble, I'm there on the double<br>
    You know that you always can call Kim Possible<br><br>
    **So what's the sitch?**<br><br>
    Call me, beep me if you wanna reach me</i></td>
  </tr>
</table>

<br>
<input type="button" value="Set as home page" onClick="this.style.behavior='url(#default#homepage)'; this.setHomePage('http://www.kpfanworld.com')"><br><br>
<?php
footer();
?>

