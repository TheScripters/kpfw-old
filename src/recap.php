<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******recap.php****************/
require("includes/functions.php");
if ($_GET['mode'] == "recap" && isset($_GET['ep']))
  {
    incheader("Episode Recap");
    $epinfo = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_GET['ep']."'"));
    $recap = mysql_fetch_array(mysql_query("SELECT EpRecap FROM kpfw_epguide WHERE EpId = '".$_GET['ep']."'"));
    echo "<h2>".$epinfo['EpTitle']."</h2>";
    echo "<br><br><table width=\"50%\" align=\"center\"><tr><td>".nl2br(bbcode(strip_gpc_slashes($recap['EpRecap'])))."</td></tr></table><br>";
    footer();
  }
 elseif ($_GET['mode'] == "script" && isset($_GET['ep']))
  {
    incheader("Episode Transcript");
    print "<br><br><a href=\"http://www.kpfanworld.com/transcript\">Back to Transcript List</a>";
    $epinfo = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_GET['ep']."'"));
    $script = mysql_fetch_array(mysql_query("SELECT ScriptText FROM kpfw_transcript WHERE EpId = '".$_GET['ep']."'"));
    echo "<h2><a name=\"top\">".$epinfo['EpTitle']."</a></h2>";
    echo "<br><br><table width=\"50%\" align=\"center\">".nl2br(bbcode(strip_gpc_slashes($script['ScriptText'])))."</td></tr></table><a href=\"transcript/".$_GET['ep']."#top\">Back to top</a><br>";
    footer();
  }
 elseif ($_GET['mode'] == "scriptlist")
  {
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_transcript"));
    $scrptcount = round($count['count'] / 2);
    $scrptcnt = $count['count'] - $scrptcount;
    incheader("Transcript List");
    include("includes/guides_table.inc");
    $scriptcount = mysql_fetch_array(mysql_query("SELECT COUNT(ScriptText) AS count FROM kpfw_transcript WHERE ScriptText != ''"));
    echo "<br><b>".$scriptcount['count']."</b> Transcripts Online<br><hr width=\"200\"><br>";
    $scriptsql = mysql_query("SELECT * FROM kpfw_transcript ORDER BY EpId ASC LIMIT 0,".$scrptcount);
    echo "<table align=\"center\"><tr><td><ul style=\"list-style:none\">";
    while($script = mysql_fetch_array($scriptsql))
      {
        $epinfo = mysql_fetch_array(mysql_query("SELECT EpTitle,EpNumber FROM kpfw_eplist WHERE EpId = '".$script['EpId']."'"));
        echo "<li>".$epinfo['EpNumber'].". ";
        ($script['ScriptText']) ? print "<a href=\"transcript/".$script['EpId']."\">".stripslashes($epinfo['EpTitle'])."</a></li>\n" : print stripslashes($epinfo['EpTitle'])."</li>\n";
      }
    echo "</ul></td><td valign=\"top\"><ul style=\"list-style:none\">";
    $scriptsql1 = mysql_query("SELECT * FROM kpfw_transcript ORDER BY EpId ASC LIMIT ".$scrptcount.",".$scrptcnt);
    while($script1 = mysql_fetch_array($scriptsql1))
      {
        $epinfo1 = mysql_fetch_array(mysql_query("SELECT EpTitle,EpNumber FROM kpfw_eplist WHERE EpId = '".$script1['EpId']."'"));
        echo "<li>".$epinfo1['EpNumber'].". ";
        ($script1['ScriptText']) ? print "<a href=\"transcript/".$script1['EpId']."\">".stripslashes($epinfo1['EpTitle'])."</a></li>\n" : print stripslashes($epinfo1['EpTitle'])."</li>\n";
      }
    echo "</ul></td></tr></table>";
    footer();
  }
?>
