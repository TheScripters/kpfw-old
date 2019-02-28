<?php
// Code © 2007 KPFanWorld.com
// COde written by Adam Humpherys
/*******listing.php**************/
include "includes/functions.php";
if (!$_GET['user']) {
  incheader("Story Listing By Title");
  if (!$_GET['chapters']) {
    echo "<center><a href=\"listing/chapters\">Show Chapters</a></center><br>\n";
  } else {
    echo "<center><a href=\"listing\">Hide Chapters</a></center><br>\n";
  }
  echo "<table width=\"45%\" align=\"center\"><tr><td>";
  echo "<ul>\n";
  $titlelist = mysql_query("SELECT FF_Id,Title,UserId FROM kpfw_fftitles ORDER BY Title ASC");
  while($title = mysql_fetch_array($titlelist))
    {
      $userinfo = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$title['UserId']."'"));
      echo "<li><a href=\"fic/".$title['FF_Id']."/1\">".$title['Title']."</a> -- <i><b>By:</b> <a href=\"profile.php?user=".$title['UserId']."\">".$userinfo['UserName']."</a></i>\n";
      if ($_GET['chapters']){
        echo "<ul>";
        $chaplist = mysql_query("SELECT Chapter,ChapterTitle FROM kpfw_ffchapter WHERE FicId = '".$title['FF_Id']."' ORDER BY Chapter");
        while($chapter = mysql_fetch_array($chaplist))
          {
            echo "<li><a href=\"fic/".$title['FF_Id']."/".$chapter['Chapter']."\">".$chapter['ChapterTitle']."</a></li>\n";
          }
        echo "</ul>";
      }
      echo "</li>";
    }
  echo "</ul>\n</td></tr></table>";
  footer();
} else {
  if (is_string($_GET['user'])){
    $userid = mysql_fetch_array(mysql_query("SELECT UserId FROM kpfw_users WHERE UserName = '".$_GET['user']."'"));
    $user_id = $userid['UserId'];
    $user = $_GET['user'];
  } elseif (is_int($_GET['user'])){
    $userinfo = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$_GET['user']."'"));
    $user_id = $_GET['user'];
    $user = $userinfo['UserName'];
  }
  incheader("Story Listing By Author");
  echo "<h2>Stories by ".$user."</h2>";
  if (!$_GET['chapters']) {
    echo "<center><a href=\"listing/chapters\">Show Chapters</a></center><br>\n";
  } else {
    echo "<center><a href=\"listing\">Hide Chapters</a></center><br>\n";
  }
  echo "<table width=\"45%\" align=\"center\"><tr><td>";
  echo "<ul>\n";
  $titlelist = mysql_query("SELECT FF_Id,Title FROM kpfw_fftitles WHERE UserId = '".$user_id."' ORDER BY Title ASC");
  while($title = mysql_fetch_array($titlelist))
    {
      echo "<li><a href=\"fic/".$title['FF_Id']."\">".$title['Title']."</a>\n";
      if ($_GET['chapters']){
        echo "<ul>";
        $chaplist = mysql_query("SELECT Chapter,ChapterTitle FROM kpfw_ffchapter WHERE FicId = '".$title['FF_Id']."' ORDER BY Chapter");
        while($chapter = mysql_fetch_array($chaplist))
          {
            echo "<li><a href=\"fic/".$title['FF_Id']."/".$chapter['Chapter']."\">".$chapter['ChapterTitle']."</a></li>\n";
          }
        echo "</ul>";
      }
      echo "</li>";
    }
  echo "</ul>\n</td></tr></table>";
  footer();
}
?>
