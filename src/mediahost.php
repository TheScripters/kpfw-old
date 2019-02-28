<?php
// Code © KPFanWorld.com
// Code written by Adam Humpherys
/*******mediahost.php************/
include("includes/functions.php");
if (!$_GET['mode'] && $_GET['type'] == "audio"){
  incheader("Audio hosting");
  echo "<br><br><h3>File List</h3>";
  echo "<table align=\"center\" width=\"50%\"><tr><td><ul style=\"list-style:none\">";
  $audiosql = mysql_query("SELECT * FROM kpfw_audio");
  while ($audio = mysql_fetch_array($audiosql))
    {
      $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$audio['UserId']."'"));
      echo "<li><b>".$audio['FileTitle']."</b> - <a href=\"profile.php?user=".$audio['UserId']."\">".$user['UserName']."</a><br>\n";
      echo nl2br($audio['Description'])."<br>\n";
      echo "<embed src=\"audio/".$audio['FileName']."\" autostart=\"false\">";
      echo "<br><hr width=\"50%\" size=\"2\" color=\"#00FF00\"><br></li>";
    }
  echo "</ul></td></tr></table><br>";
  if ($_SESSION['logged_in']){
    echo "<b>Max File Size: 8 MB</b> -- MP3/OGG audio only, please.<br>OGG codec can be downloaded <a href=\"util/OggDS0995.exe\">here</a>.<br>";
    echo "<table align=\"center\"><tr><td align=\"right\">";
    echo "<form action=\"mediahost.php?mode=submit\" method=\"post\" enctype=\"multipart/form-data\">\n";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"8388608\">";
    echo "<input type=\"hidden\" name=\"format\" value=\"audio\">";
    echo "<b>File Title:</b></td><td><input type=\"text\" name=\"filetitle\"></td></tr>\n";
    echo "<tr><td align=\"right\"><b>File Name:</b></td><td><input type=\"file\" name=\"media\"></td></tr>\n";
    echo "<tr><td align=\"right\" valign=\"top\"><b>File Description:</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"filedesc\"></textarea></td></tr>\n";
    echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Upload\"></form></td></tr></table>";
  }
  footer();
} elseif (!$_GET['mode'] && $_GET['type'] == "video"){
  incheader("Video Hosting");
  echo "<br><br><h3>File List</h3>";
  echo "<table align=\"center\" width=\"50%\"><tr><td><ul style=\"list-style:none\">";
  $videosql = mysql_query("SELECT * FROM kpfw_video");
  while ($video = mysql_fetch_array($videosql))
    {
      $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$video['UserId']."'"));
      echo "<li><b><a href=\"video/".$video['FileName']."\">".$video['FileTitle']."</a></b> - <a href=\"profile.php?user=".$video['UserId']."\">".$user['UserName']."</a><br>\n";
      echo nl2br($video['Description'])."<br>\n";
      //echo "<embed src=\"audio/".$audio['FileName']."\" autostart=\"false\">";
      echo "<br><hr width=\"50%\" size=\"2\" color=\"#00FF00\"><br></li>";
    }
  echo "</ul></td></tr></table><br>";
  if ($_SESSION['logged_in']){
    echo "<b>Max File Size: 20 MB</b> -- WMV/AVI (DivX/XviD)/OGM<br>OGG/OGM codec can be downloaded <a href=\"util/OggDS0995.exe\">here</a>.<br>";
    echo "<table align=\"center\"><tr><td align=\"right\">";
    echo "<form action=\"mediahost.php?mode=submit\" method=\"post\" enctype=\"multipart/form-data\">\n";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"20971520\">";
    echo "<input type=\"hidden\" name=\"format\" value=\"video\">";
    echo "<b>File Title:</b></td><td><input type=\"text\" name=\"filetitle\"></td></tr>\n";
    echo "<tr><td align=\"right\"><b>File Name:</b></td><td><input type=\"file\" name=\"media\"></td></tr>\n";
    echo "<tr><td align=\"right\" valign=\"top\"><b>File Description:</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"filedesc\"></textarea></td></tr>\n";
    echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Upload\"></form></td></tr></table>";
  }
  footer();
} elseif (!$_GET['mode'] && $_GET['type'] == "dialog"){
  incheader("Dialog Clip Hosting");
  echo "<br><br><h3>File List</h3>";
  echo "<table align=\"center\" width=\"350\"><tr><td><ul style=\"list-style:none\">";
  $dialogsql = mysql_query("SELECT * FROM kpfw_dialog");
  while ($dialog = mysql_fetch_array($dialogsql))
    {
      $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$dialog['UserId']."'"));
      echo "<li><b>".$dialog['FileTitle']."</b> - <a href=\"profile.php?user=".$dialog['UserId']."\">".$user['UserName']."</a><br>\n";
      echo nl2br($dialog['Description'])."<br>\n";
      echo "<a href=\"dialog/".$dialog['FileName']."\">".$dialog['FileName']."</a>";
      echo "<br><hr width=\"50%\" size=\"2\" color=\"#00FF00\"><br></li>";
    }
  echo "</ul></td></tr></table><br>";
  if ($_SESSION['logged_in']){
    echo "<b>Max File Size: 5 MB</b> -- Wav/MP3/OGG<br>OGG codec can be downloaded <a href=\"util/OggDS0995.exe\">here</a>.<br>";
    echo "<table align=\"center\"><tr><td align=\"right\">";
    echo "<form action=\"mediahost.php?mode=submit\" method=\"post\" enctype=\"multipart/form-data\">\n";
    echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"5242880\">";
    echo "<input type=\"hidden\" name=\"format\" value=\"dialog\">";
    echo "<b>File Title:</b></td><td><input type=\"text\" name=\"filetitle\"></td></tr>\n";
    echo "<tr><td align=\"right\"><b>File Name:</b></td><td><input type=\"file\" name=\"media\"></td></tr>\n";
    echo "<tr><td align=\"right\" valign=\"top\"><b>File Description:</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"filedesc\"></textarea></td></tr>\n";
    echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Upload\"></form></td></tr></table>";
  }
  footer();
} elseif ($_GET['mode'] == "submit") {
  $tbl = $_REQUEST['format'];
  $dir = "/home/kpfanwor/public_html/".$tbl."/";
  $newfile = $dir.basename($_FILES['media']['name']);
  move_uploaded_file($_FILES['media']['tmp_name'], $newfile);
  $sql = mysql_query("INSERT INTO kpfw_".$tbl." VALUES (NULL, '".basename($_FILES['media']['name'])."', '".$_REQUEST['filetitle']."', '".$_REQUEST['filedesc']."', '".$_SESSION['userID']."')");
  $new = basename($_FILES['media']['name'])." -- ".$_REQUEST['filedesc'];
  mail_admin("Media>".ucwords($tbl),0,$new);
  header("Location: media/".$tbl);
}
?>
