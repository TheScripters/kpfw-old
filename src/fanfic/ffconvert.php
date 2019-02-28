<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******ffconvert.php************/
/********************************/
/***Fanfiction Conversion Tool***/
include("./includes/functions.php");
if (!$_SESSION['logged_in']){
  header("Location:./login.php?r=ffconvert.php");
} elseif ($_SESSION['logged_in'] && (!$_REQUEST['user'] || !$_REQUEST['email']) && !$_REQUEST['action']) {
  echo "<center>";
  echo "<br><br><h1>FanFic Conversion</h1>\n";
  echo "<form action=\"ffconvert.php\" method=\"post\">\n";
  echo "<b>KPFF UserName:</b> <input type=\"text\" name=\"user\"><br>\n";
  echo "<b>KPFF Email:</b> <input type=\"text\" name=\"email\"><br>\n";
  echo "<input type=\"submit\" value=\"Submit\"></form>";
} elseif ($_SESSION['logged_in'] && $_REQUEST['user'] && $_REQUEST['email'] && !$_REQUEST['action']) {
  $author = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpff_authors WHERE AuthorName = '".$_REQUEST['user']."' AND AuthorEmail = '".$_REQUEST['email']."'"));
  ($author['cnt'] == "0") ? header("Location: ./ffconvert.php") : "";
  $ficsql = mysql_query("SELECT fanFicId,FicTitle,COUNT(*) AS count FROM kpff_fics WHERE author = '".$_REQUEST['user']."' GROUP BY FicTitle ORDER BY fanFicId ASC");
  echo "<center>";
  echo "<br><br><h1>FanFic Conversion</h1>\n<form action=\"ffconvert.php?action=continue\" method=\"post\">\n";
  echo "<ul>";
  while($fic = mysql_fetch_array($ficsql))
    {
      $chap_s = ($fic['count'] == 1) ? "chapter" : "chapters";
      echo "<li><input type=\"checkbox\" name=\"fic[]\" value=\"".$fic['fanFicId']."\"> ".$fic['FicTitle']." -- ".$fic['count']." ".$chap_s."</li>";
    }
  echo "</ul>";
  //echo "<input type=\"hidden\" name=\"action\" value=\"continue\">";
  echo "<input type=\"submit\" value=\"Convert!\"></form>";
} /*elseif ($_SESSION['logged_in'] && $_REQUEST['action'] == "merge" && !$_REQUEST['newfic']) {
  echo "<center>";
  echo "<br><br><h1>FanFic Conversion</h1>\n";
  echo "<form action=\"./ffconvert.php?action=merge\" method=\"post\">\n";
  foreach ($_REQUEST['fic'] as $fic)
    {
      $fictitle = mysql_fetch_array(mysql_query("SELECT FicTitle FROM kpff_fics WHERE fanFicId = '".$fic."'"));
      echo "<input type=\"radio\" name=\"newfic\" value=\"".$fic."\"> ".$fictitle['FicTitle']."<br>\n";
      echo "<input type=\"hidden\" name=\"oldfic[]\" value=\"".$fic."\">\n";
    }
  echo "<input type=\"submit\" value=\"Submit\"></form>";
} elseif ($_SESSION['logged_in'] && $_REQUEST['newfic'] && $_GET['action'] == "merge") {
  $fic = mysql_fetch_array(mysql_query("SELECT FicTitle FROM kpff_fics WHERE fanFicId = '".$_REQUEST['newfic']."'"));
  foreach ($_REQUEST['oldfic'] as $old)
    {
      $sql = mysql_query("UPDATE kpff_fics SET FicTitle = '".$fic['FicTitle']."' WHERE fanFicId = '".$old."'");
    }
  $cnt = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpff_fics WHERE FicTitle = '".$fic['FicTitle']."'"));
  $sql = mysql_query("INSERT INTO kpfw_fftitles VALUES (NULL, '".$fic['FicTitle']."', '".$cnt['cnt']."', '".$_SESSION['userID']."')");
  echo "<b>".$fic['FicTitle']."</b> successfully merged!<br>\n";
  $ficId = mysql_insert_id();
  $chapsql = mysql_query("SELECT chapter,ChapNum FROM kpff_fics WHERE FicTitle = '".$fic['FicTitle']."'");
  while($chapter = mysql_fetch_array($chapsql))
    {
      $sql = mysql_query("INSERT INTO kpfw_ffchapter VALUES ('".$ficId."', '".$chapter['ChapNum']."', '".$_SESSION['userID']."', '".time()."', '".$chapter['chapter']."')");
      echo $chapter['ChapNum']." ".$chapter['chapter']." successfully converted!<br>\n";
    }
  echo "Operation Completed!";
  exit;
}*/ elseif ($_SESSION['logged_in'] && $_GET['action'] == "continue") {
  echo "Processing...<br><br><ol>\n";
  foreach ($_REQUEST['fic'] as $fic)
    {
      $sql = mysql_fetch_array(mysql_query("SELECT ficTitle FROM kpff_fics WHERE fanFicId = '".$fic."'"));
      $ficsql = mysql_query("SELECT ficText,chapter,datePosted FROM kpff_fics WHERE ficTitle = '".$sql['ficTitle']."'");
      $ficins = mysql_query("INSERT INTO kpfw_fftitles VALUES(NULL, '".$sql['ficTitle']."','0','".$_SESSION['userID']."','Yes')");
      $ficid = mysql_insert_id();
      echo "<li>".$sql['ficTitle']."</li><ol>\n";
      while($fics = mysql_fetch_array($ficsql))
        {
          $ficdate = str_replace(",","",$fics['datePosted']);
          $ficdate = str_replace(":"," ",$ficdate);
          $code = array('<i>','</i>','<b>','</b>','<u>','</u>','<center>','</center>');
          $code_rep = array('[i]','[/i]','[b]','[/b]','[u]','[/u]','[center]','[/center]');
          $fictext = str_replace($code,$code_rep,$fics['ficText']);
          $months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
          $replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
          $ficdate = str_replace($months,$replace,$ficdate);
          $date = explode(" ",$ficdate);
          $time = mktime($date[4],$date[5],$date[6],$date[2],$date[1],$date[3]);
          $chap = mysql_fetch_array(mysql_query("SELECT Chapter FROM kpfw_ffchapter WHERE FicId = '".$ficid."' ORDER BY Chapter DESC LIMIT 1"));
          $chapnum = $chap['Chapters'] + 1;
          $chins = mysql_query("INSERT INTO kpfw_ffchapter VALUES ('".$ficid."', '".$chapnum."','".$_SESSION['userID']."', '".$time."', '".$fics['chapter']."', '".addslashes($fictext)."')");
          echo "<li>".$fics['chapter']."</li>";
          $ficchap = mysql_fetch_array(mysql_query("SELECT Chapters FROM kpfw_fftitles WHERE FF_Id = '".$ficid."'"));
          $numch = $ficchap['Chapters'] + 1;
          $sql = mysql_query("UPDATE kpfw_fftitles SET Chapters = '".$numch."' WHERE FF_Id = '".$ficid."'");
        }
      echo "</ol>";
    }
  echo "</ol><br><br>\n";
  //Begin Debugging lines -->
  echo "<ul>";
  echo "<li>".$numch."</li>";
  echo "<li>".$time."</li>";
  echo "<li>".nl2br($fictext)."</li>";
  echo "</ul><br><br>\n\n";
  // <-- End Debugging lines
  echo "<b>Operation Completed!</b><br>";
  echo "<a href=\"http://fanfic.kpfanworld.com\">Click here</a> to return to KP Fan World's FanFiction site.";
  exit;
}
echo "</center>";
?>
