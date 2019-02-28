<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/lcat.php***********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode'] && !$_REQUEST['cat']){
  ?>
  <h2>Link Category Management</h2><br>
  <?php
  include("admin/menu.php");
  ?>    <center>
    <br><form action="admin.php?page=lcat" method="post">
    <h3>Edit Categories</h3>
    <select name="cat"><?php
    $catlist = mysql_query("SELECT * FROM kpfw_linkcat");
    while($cat = mysql_fetch_array($catlist))
      {
        echo "<option name=\"cat\" value=\"".$cat['CatID']."\">".$cat['Link_Cat']."</option>\n";
      }
    ?></select><br>
    <input type="submit" value="Edit"></form>
    <br><br>
    <form action="admin.php?page=lcat&mode=remove" method="post">
    <h3>Remove Categories</h3>
    <select name="cat[]" size="6" multiple><?php
    $catlist1 = mysql_query("SELECT * FROM kpfw_linkcat");
    while($cat1 = mysql_fetch_array($catlist1))
      {
        echo "<option name=\"cat\" value=\"".$cat1['CatID']."\">".$cat1['Link_Cat']."</option>\n";
      }
    ?></select><br><br>
    <b>New Category For Displaced Links:</b><br><select name="newcat"><?php
    $catlist2 = mysql_query("SELECT * FROM kpfw_linkcat");
    while($cat2 = mysql_fetch_array($catlist2))
      {
        echo "<option name=\"newcat\" value=\"".$cat2['CatID']."\">".$cat2['Link_Cat']."</option>\n";
      }
    ?></select><br>
    <input type="submit" value="Remove"></form>
    <br><br>
    <form action="admin.php?page=lcat&mode=add" method="post">
    <h3>Add Category</h3>
    <input type="text" name="newcat"><br>
    <input type="submit" value="Create"></form>
    </td>
  </tr>
</table><?php
}
elseif (!$_GET['mode'] && $_REQUEST['cat']){
  $cat = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_linkcat WHERE CatID = '".$_REQUEST['cat']."'"));
  ?>
  <h2>Edit Category</h2><br>
  <?php
  include("admin/menu.php");
  ?>   <center>
    <br><form action="admin.php?page=lcat&mode=edit" method="post">
    <input type="hidden" name="catid" value="<?=$_REQUEST['cat']?>">
    <b>Category Title:</b> <input type="text" name="cat_title" value="<?=$cat['Link_Cat']?>"><br>
    <input type="submit" value="Submit"></form><br>
    </td>
  </tr>
</table>
  <?php
}
elseif ($_GET['mode'] == "remove"){
  foreach ($_REQUEST['cat'] as $cat)
    {
      $sql = mysql_query("DELETE FROM kpfw_linkcat WHERE CatID = '".$cat."'");
      $sql = mysql_query("UPDATE kpfw_links SET CatID = '".$_REQUEST['newcat']."' WHERE CatID = '".$cat."'");
    }
  header("Location: admin.php?page=lcat");
}
elseif ($_GET['mode'] == "edit"){
  $sql = mysql_query("UPDATE kpfw_linkcat SET Link_Cat = '".$_REQUEST['cat_title']."' WHERE CatID = '".$_REQUEST['catid']."'");
  header("Location: admin.php?page=lcat");
}
elseif ($_GET['mode'] == "add"){
  $sql = mysql_query("INSERT INTO kpfw_linkcat VALUES (NULL, '".$_REQUEST['newcat']."')");
  header("Location: admin.php?page=lcat");
}
?>
