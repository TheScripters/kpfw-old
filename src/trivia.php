<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******trivia.php***************/
include("includes/functions.php");
if (!isset($_GET['ep']))
  {
    incheader("KP Trivia Listing");
    include("includes/guides_table.inc");
    echo "<br><br><table align=\"center\" width=\"20%\" border=\"0\">";
    echo "<tr><td align=\"left\">";
    $trivlist = mysql_query("SELECT EpNumber,EpTitle FROM kpfw_eplist ORDER BY EpId ASC");
    while($trivia = mysql_fetch_array($trivlist))
      {
        $trivialist = Ep_Trivia_Link($trivia['EpTitle']);
        echo "<b>".$trivia['EpNumber']."</b>&nbsp;&nbsp;";
        if (file_exists("trivia/".$trivialist.".php"))
          {
            echo "<a href=\"trivia/".$trivialist."\">".strip_gpc_slashes($trivia['EpTitle'])."</a><br>\n";
          }
         else
          {
            echo $trivia['EpTitle']."<br>\n";
          }
      }
    echo "</td></tr></table>";
    footer();
  }
 else
  {
    include("includes/trivconst.php");
    $eptriv = strtoupper($_GET['ep']);
    if (!defined($eptriv))
      {
        $title = $_GET['ep'];
        $title = preg_replace("/_/"," ",$title);
        $title = ucwords($title);
      }
     else
      {
        $title = $eptriv;
      }
    incheader($title." Trivia");
    include("includes/guides_table.inc");
    include("trivia/".$_GET['ep'].".php");
    footer();
  }
?>
