<?php
// Code © 2007 KPFanWorld.com
// Code written by Adam Humpherys
/*******addfic.php***************/
include "includes/functions.php";
if (!$_SESSION['logged_in']){
  header("Location: index.php");
} elseif ($_SESSION['logged_in'] && $_REQUEST['mode'] == "add"){
  if ($_REQUEST['fic'] == "new"){
    $sql = mysql_query("INSERT INTO kpfw_fftitles (NULL, '".$_REQUEST['fictitle']."', '0' '".$_SESSION['userID']."','Yes')");
    $ficid = mysql_insert_id();
    $chapter = 1;
  } else {
    $ficid = $_REQUEST['fic'];
    $chapsel = mysql_fetch_array(mysql_query("SELECT Chapter FROM kpfw_ffchapter WHERE FicId = '".$ficid."' ORDER BY Chapter LIMIT 1"));
    $chapter = $chapsel['Chapter'] + 1;
  }
  if ($_REQUEST['title_only'] == "true") {
    $sql = mysql_query("UPDATE kpfw_fftitles SET Public = 'No' WHERE FF_Id = '".$ficid."'");
    header("Location: index.php");
  }
  $sql = mysql_query("INSERT INTO kpfw_ffchapter VALUES ('".$ficid."', '".$chapter."', '".$_SESSION['userID']."', '".$_REQUEST['chaptitle']."', '".addslashes($_REQUEST['chaptext'])."')");
  $chapcnt = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpfw_ffchapter WHERE FicId = '".$ficid."'"));
  $cnt = $chapcnt['cnt'] + 1;
  $sql = mysql_query("UPDATE kpfw_fftitles SET Chapters = '".$cnt."' WHERE FF_Id = '".$ficid."'");
  header("Location: ".$ficid."/".$chapter);
} elseif ($_SESSION['logged_in'] && !$_REQUEST['mode']) {
  incheader("Add Story/Chapter");
  echo "<form action=\"add\" method=\"post\">\n";
  echo "<br><b>Existing Story:</b> <select name=\"fic\"><option name=\"fic\" value=\"new\">New</option>\n";
  $ficsql = mysql_query("SELECT FF_Id,Title,Chapters FROM kpfw_fftitles WHERE UserId = '".$_SESSION['userID']."'");
  while($fic = mysql_fetch_array($ficsql))
    {
      echo "<option name=\"fic\" value=\"".$fic['FF_Id']."\">".$fic['Title']." (".$fic['Chapters']." Chapters)</option>\n";
    }
  echo "</select><br>\n";
  echo "<b>Title:</b> <input type=\"text\" name=\"fictitle\"> <font color=\"#FFFF00\">(If \"New\")</font><br>\n";
  echo "<input type=\"checkbox\" name=\"title_only\" value=\"true\"> New title only<br>";
  echo "<span style=\"color:#FF0000;font-size:8pt\">If selected title will be added only and will not be visible</span>";
  echo "<br><br>\n";
  echo "<b>Chapter Title:</b> <input type=\"text\" name=\"chaptitle\"><br>\n";
  echo "<br><b>Chapter Text:</b><br><input type=\"button\" onclick=\"window.open('bbcode.html','','location=no,menubar=no,status=no,scrollbars=no,resizable=no,toolbar=no,width=462,height=525');\" value=\"Available BBCode\"><br><textarea name=\"chaptext\" rows=\"20\" cols=\"70\"></textarea><br><br>";
  echo "<input type=\"submit\" value=\"Submit\"></form><br><br>\n";
  footer();
}
?>
