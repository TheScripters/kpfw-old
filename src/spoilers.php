<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******spoilers.php*************/
include("includes/functions.php");
incheader("Kim Possible Spoiler Section");
include("includes/guides_table.inc");
if ($_GET['p'] == "submit")
  {
    if ($_GET['err'] == "true")
     {
       include("spoilers/db-err.inc");
     }
    include("spoilers/submit.php");
    footer();
  }
if ($_GET['confirm'] == "true")
  {
    if ($_GET['mode'] == "submit" && isset($_SESSION['logged_in']))
     {
       include("spoilers/submit.inc");
       footer();
     }
    elseif (!$_GET['mode'] && !isset($_SESSION['logged_in']) || isset($_SESSION['logged_in']))
     {
       include("spoilers/main.php");
       footer();
     }
  }
if ($_GET['mode'] == "confrim" && isset($_GET['spoiler']))
  {
    $SpoilerID = $_GET['spoiler'];
    $sql = mysql_query("UPDATE kpfw_spoiler SET Confirmation = 'True' WHERE SpoilerID = '".$SpoilerID."'");
    header("Location: spoilers?show=kp&confirm=true");
  }
 else
  {
    include("spoilers/kp.php");
  }
footer();
?>
