<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******ytvid.php****************/
include("includes/functions.php");
if ($_SESSION['logged_in'] && !isset($_GET['vid']) && !isset($_REQUEST['mode']))
  {
    incheader("Submit YouTube Video");
    ?><br>This form allows you to "upload" a video to KP Fan World that's already online at YouTube.com. Find the video ID from the URL and enter it below.<br><br>You can find it by looking after the "watch?v=" For example, you would enter the <b>bold</b> string:<br>http://www.youtube.com/watch?v=<b>wPCD9LKlg5A</b> (in this example ONLY enter wPCD9LKlg5A)<br><br>Hit submit, and that's it. We'll do the rest.<br>
    <form action="ytvid.php">
    <input type="text" maxlength="15" name="vid"><br>
    <input type="submit" value="Submit"></form>
    <?
    footer();
  }
if ($_SESSION['logged_in'] && $_GET['vid'] && !isset($_REQUEST['mode']))
  {
    $title = get_meta_tags("http://www.youtube.com/watch?v=".$_GET['vid']);
    incheader("Submit YouTube Video");
    ?><br>We will attempt to acquire the video's title and description automatically. You have the chance to change it, if necessary, below.<br><br>If you're not the original creator of the video, we do ask that you state the known name of the original creator in the title and/or description.<br><br>
    <form action="ytvid.php?mode=submit" method="post">
    <table align="center"><tr><td align="right"><input type="hidden" name="vid" value="<?=$_GET['vid']?>"
    <b>Title:</b></td><td><input type="text" name="title" value="<?=stripslashes($title['title'])?>"></td></tr>
    <tr><td align="right"><b>Description:</b></td>
    <td><textarea cols="40" rows="6" name="description"><?=stripslashes($title['description'])?></textarea></td></tr></table><input type="submit" value="Submit"></form>
    <?
    footer();
  }
if ($_SESSION['logged_in'] && $_REQUEST['mode'] == "submit")
  {
    $vid = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_youtubevid WHERE YT_Vid_ID = '".$_REQUEST['vid']."'"));
    if ($vid['count'] == "0")
      {
        $sql = mysql_query("INSERT INTO kpfw_youtubevid VALUES (NULL, '".$_SESSION['userID']."', '".$_REQUEST['vid']."', '".$_REQUEST['title']."', '".$_REQUEST['description']."')");
        $vidID = mysql_insert_id();
        header("Location: youtube/$vidID#vid");
      }
     else
      {
        incheader("Submit YouTube Video");
        echo "<center>This video has already been submitted. Please check the video listing <a href=\"youtube\">here</a></center>";
        footer();
      }
  }
if (!$_SESSION['logged_in'])
  {
    header("Location: login.php?r=ytvid.php");
  }
?>
