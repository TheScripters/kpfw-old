<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/index_news.php*****/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  $news_active = mysql_fetch_array(mysql_query("SELECT Config_Value as active FROM kpfw_config WHERE Config_ID = 'Index_News_Active'"));
  $newstxt = mysql_fetch_array(mysql_query("SELECT Config_Value as news FROM kpfw_config WHERE Config_ID = 'Index_News'"));
  $active = ($news_active['active'] == "True") ? " CHECKED": "";
  ?>
  <h2>Index News</h2><br>
  <?php
  include("admin/menu.php");
  ?>  <center>
    <br><form action="admin.php?page=index_news&mode=edit" method="post">
    <textarea rows="5" cols="65" name="newsText"><?=$newstxt['news']?></textarea><br><br>
    <input type="checkbox" name="nwsactive"<?=$active?> value="True"> Active?<br><br>
    <input type="submit" value="Submit"></form>
    </td>
  </tr>
</table>
<?php
} elseif ($_GET['mode'] == "edit") {
  $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$_REQUEST['newsText']."' WHERE Config_ID = 'Index_News'");
  $active = ($_REQUEST['nwsactive'] == "True") ? "True" : "False";
  $sql = mysql_query("UPDATE kpfw_config SET Config_Value = '".$active."' WHERE Config_ID = 'Index_News_Active'");
  header("Location: admin.php?page=index_news");
}
?>
