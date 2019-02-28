<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/meta.php*********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
?>
<h2>Meta Tags</h2><br>
<?php
include("admin/menu.php");
$keyword = mysql_fetch_array(mysql_query("SELECT Config_Value FROM kpfw_config WHERE Config_ID = 'Keywords'"));
$description = mysql_fetch_array(mysql_query("SELECT Config_Value FROM kpfw_config WHERE Config_ID = 'Description'"));
?>
      <table align="center">
        <tr><form action="admin.php?page=config&mode=update" method="post">
          <td align="right"><b>Keywords:</b></td>
          <td><textarea cols="50" rows="4" name="keyword"><?=$keyword['Config_Value']?></textarea></td>
        </tr>
        <tr>
          <td align="right"><b>Description:</b></td>
          <td><textarea cols="50" rows="4" name="description"><?=$description['Config_Value']?></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
</table><?php
}
else
 {
   $keyword = $_REQUEST['keyword'];
   $descrip = $_REQUEST['description'];
   $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$keyword."' WHERE Config_ID = 'Keywords'");
   $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$descrip."' WHERE Config_ID = 'Description'");
   header("Location: admin.php?page=meta");
 }
