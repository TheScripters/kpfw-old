<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******cfgupdate.php************/
include("../includes/functions.php");
$keyword = $_REQUEST['keyword'];
$descrip = $_REQUEST['description'];
if ($_SESSION['UserLevel'] == "3" && isset($_REQUEST['keyword']) && isset['description'])
  {
    $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$keyword."' WHERE Config_ID = 'Keywords'");
    $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$descrip."' WHERE Config_ID = 'Description'");
    header("Location: admin.php?page=config");
  }
 else
  {
    header("Location: index.php");
  }
?>
