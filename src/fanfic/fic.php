<?php
// Code © 2007 KPFanWorld.com
// Code written by Adam Humpherys
/*******fic.php******************/
include "includes/functions.php";
if ($_GET['fic'] != "list" && $_GET['fic'] && $_GET['chap']){
  incheader("View Story");
  $ficinfo = mysql_fetch_array(mysql_query("SELECT Title,UserId FROM kpfw_fftitles WHERE FF_Id = '".$_GET['fic']."'"));
  $chapinfo = mysql_fetch_array(mysql_query("SELECT Date,ChapterTitle,ChapterText FROM kpfw_ffchapter WHERE FicId = '".$_GET['fic']."' AND Chapter = '".$_GET['chap']."'"));
  $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$ficinfo['UserId']."'"));
  echo "<h2 style=\"margin-bottom:5px\">".$ficinfo['Title']."</h2>";
  echo "<h4 style=\"margin-top:5px;margin-bottom:10px\">".$chapinfo['ChapterTitle']."</h4>";
  echo "<center>".date("d M Y h:i:s A",$chapinfo['Date'])."<br>";
  echo "By: ".$user['UserName']."</center><br><br><table width=\"65%\" align=\"center\">";
  echo "<tr><td align=\"left\" width=\"33%\">";
  if ($_GET['chap'] > 1){
    $prevchap = $_GET['chap'] - 1;
    echo "<a href=\"/fic/".$_GET['fic']."/".$prevchap."\">Previous Chapter</a>";
  }
  echo "</td>";
  $totchap = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_ffchapter WHERE FicId = '".$_GET['fic']."'"));
  if ($totchap['count'] >= 2) {
    echo "<td align=\"center\" width=\"34%\"><form name=\"jump1\"><select name=\"menu1\">";
    $chapsql = mysql_query("SELECT Chapter,ChapterTitle FROM kpfw_ffchapter WHERE FicId = '".$_GET['fic']."' AND Chapter != '".$_GET['chap']."' ORDER BY Chapter ASC");
    while($chapsel = mysql_fetch_array($chapsql))
      {
        echo "<option value=\"http://www.kpfanfiction.com/fic/".$_GET['fic']."/".$chapsel['Chapter']."\">".$chapsel['ChapterTitle']."</option>\n";
      }
    echo "</select>\n<input type=\"button\" onClick=\"location=document.jump1.menu1.options[document.jump1.menu1.selectedIndex].value;\" value=\"GO\"></form>";
    echo "</td>";
  }
  echo "<td align=\"right\" width=\"33%\">";
  $nextchap = $_GET['chap'] + 1;
  $chap = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_ffchapter WHERE FicId = '".$_GET['fic']."' AND Chapter = '".$nextchap."'"));
  if ($chap['count'] == 1){
    echo "<a href=\"/fic/".$_GET['fic']."/".$nextchap."\">Next Chapter</a>";
  }
  echo "</td></tr>";
  echo "<tr><td colspan=\"3\">";
  echo stripslashes(nl2br(bbcode($chapinfo['ChapterText'])));
  echo "</td></tr>";
  echo "<tr><td align=\"left\" width=\"33%\">";
  if ($_GET['chap'] > 1){
    $prevchap = $_GET['chap'] - 1;
    echo "<a href=\"/fic/".$_GET['fic']."/".$prevchap."\">Previous Chapter</a>";
  }
  echo "</td>";
  if ($totchap['count'] >= 2) {
    echo "<td align=\"center\" width=\"34%\"><form name=\"jump1\"><select name=\"menu1\">";
    $chapsql = mysql_query("SELECT Chapter,ChapterTitle FROM kpfw_ffchapter WHERE FicId = '".$_GET['fic']."' AND Chapter != '".$_GET['chap']."' ORDER BY Chapter ASC");
    while($chapsel = mysql_fetch_array($chapsql))
      {
        echo "<option value=\"http://www.kpfanfiction.com/fic/".$_GET['fic']."/".$chapsel['Chapter']."\">".$chapsel['ChapterTitle']."</option>\n";
      }
    echo "</select>\n<input type=\"button\" onClick=\"location=document.jump1.menu1.options[document.jump1.menu1.selectedIndex].value;\" value=\"GO\"></form>";
    echo "</td>";
  }
  echo "<td align=\"right\" width=\"33%\">";
  $nextchap = $_GET['chap'] + 1;
  $chap = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_ffchapter WHERE FicId = '".$_GET['fic']."' AND Chapter = '".$nextchap."'"));
  if ($chap['count'] == 1){
    echo "<a href=\"/fic/".$_GET['fic']."/".$nextchap."\">Next Chapter</a>";
  }
  echo "</td></tr></table><br><br>";
  footer();
} elseif ($_GET['fic'] != "list" && (!$_GET['fic'] || !$_GET['chap'])){
  header("Location: /fic/list");
} elseif ($_GET['fic'] == "list"){
  incheader("View Story List");
  echo "<br><table align=\"center\" width=\"65%\"><tr><td>";
  $listsql = mysql_query("SELECT FF_Id,Title,UserId FROM kpfw_fftitles WHERE Public = 'Yes' ORDER BY Title ASC");
  echo "<ul>";
  while($list = mysql_fetch_array($listsql))
    {
      $chapsql = mysql_query("SELECT ChapterTitle,Chapter FROM kpfw_ffchapter WHERE FicId = '".$list['FF_Id']."'");
      echo "<li style=\"margin-bottom:15px\"><b>".$list['Title']."</b>";
      echo "<ul>";
      while($chaplst = mysql_fetch_array($chapsql))
        {
          echo "<li><a href=\"fic/".$list['FF_Id']."/".$chaplst['Chapter']."\">".$chaplst['ChapterTitle']."</a></li>";
        }
      echo "</ul></li>";
    }
  echo "</ul><br></td></tr></table><br><br>";
  footer();
}
?>
