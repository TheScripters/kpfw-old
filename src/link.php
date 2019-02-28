<?php
// Code © KPFanWorld.com
// Code written by Adam Humpherys
/*******link.php*****************/
include("includes/functions.php");
if (!isset($_GET['id']))
  {
    header("Location: links.php");
  }
if (isset($_GET['id']))
  {
    $LinkID = mysql_fetch_array(mysql_query("SELECT LinkURL,LinkTitle,Hits FROM kpfw_links WHERE LinkID = '".$_GET['id']."'"));
    $OldHitValue = $LinkID['Hits'];
    $NewHitValue = $OldHitValue + 1;
    $Hits_Update = mysql_query("UPDATE kpfw_links SET Hits = '$NewHitValue' WHERE LinkID = ".$_GET['id']."");
    echo "<html>\n<head>\n<meta http-equiv=\"refresh\" content=\"5; url='".$LinkID['LinkURL']."'\">\n<title>Transferring to ".$LinkID['LinkTitle']."...</title>\n</head>\n\n<body>\n";
    echo "<center><h1>Transferring to ".$LinkID['LinkTitle']."...</h1><br><br>\n";
    echo "If page does not load in 5 seconds, click <a href=\"".$LinkID['LinkURL']."\">here</a>.<br>\n";
    echo "</body>\n</html>";
  }
?>
