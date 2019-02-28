<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******youtube.php**************/
include("includes/functions.php");
incheader("YouTube Videos");
if (!$_GET['vid'])
  {
    echo "<br><a href=\"media\">Back to Media</a><br><br>";
    echo "<h2>Video Listing</h2>";
    echo "<table align=\"center\"><tr><td><a href=\"ytvid.php\">Submit video</a><br><br>";
    $vidNumber = 1;
    $vidsql = mysql_query("SELECT * FROM kpfw_youtubevid ORDER BY Vid_ID ASC");
    while($vid = mysql_fetch_array($vidsql))
      {
        $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$vid['UserId']."'"));
        echo $vidNumber.". <a href=\"youtube/".$vid['Vid_ID']."#vid\">".$vid['Video_Title']."</a> -- Uploaded by <a href=\"profile/".$vid['UserId']."\">".$user['UserName']."</a><br>";
        $vidNumber++;
      }
    echo "<br><br><a href=\"ytvid.php\">Submit video</a></td></tr></table>";
  }
if ($_GET['vid'])
  {
    $vid = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_youtubevid WHERE Vid_ID = '".$_GET['vid']."'"));
    ?><br><a href="youtube">Back to video listing</a> || <a href="media">Back to Media</a><br><br><a name="vid"><h2><?=$vid['Video_Title']?></h2></a><center>
    <object width="418" height="333"><param name="movie" value="http://www.youtube.com/v/<?=$vid['YT_Vid_ID']?>"></param><embed src="http://www.youtube.com/v/<?=$vid['YT_Vid_ID']?>" type="application/x-shockwave-flash" width="418" height="333"></embed></object><br><table align="center" width="418"><tr><td><?=nl2br($vid['Video_Description'])?><br><br><a href="http://www.youtube.com/watch?v=<?=$vid['YT_Vid_ID']?>" target="_blank">http://www.youtube.com/watch?v=<?=$vid['YT_Vid_ID']?></a></td></tr></table><br>
    <?
  }
footer();
?>
