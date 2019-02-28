<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/links.php**********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode'] && !$_REQUEST['link']){
  ?>
  <h2>Link Management</h2><br>
  <?php
  include("admin/menu.php")
  ?>  <center>
    <br><form action="admin.php?page=links" method="post">
    <h3>Edit Link</h3>
    <select name="link"><?php
    $linklist = mysql_query("SELECT LinkID,LinkTitle FROM kpfw_links ORDER BY LinkTitle ASC");
    while($link = mysql_fetch_array($linklist))
      {
        echo "<option name=\"link\" value=\"".$link['LinkID']."\">".$link['LinkTitle']."</option>\n";
      }
    ?></select><br>
    <input type="submit" value="Edit"></form>
    <br><br>
    <form action="admin.php?page=links&mode=remove" method="post">
    <h3>Remove Links</h3>
    <select name="link[]" size="6" multiple><?php
    $linklist = mysql_query("SELECT LinkID,LinkTitle FROM kpfw_links ORDER BY LinkTitle ASC");
    while($link = mysql_fetch_array($linklist))
      {
        echo "<option name=\"link\" value=\"".$link['LinkID']."\">".$link['LinkTitle']."</option>\n";
      }
    ?></select><br>
    <input type="submit" value="Remove"></form>
    <br><br>
    </td>
  </tr>
</table>
<?php
}
elseif (!$_GET['mode'] && $_REQUEST['link']){
  $link = mysql_fetch_array(mysql_query("SELECT LinkTitle,LinkURL,LinkDescription,Banner,Hits,UserId,CatID FROM kpfw_links WHERE LinkID = '".$_REQUEST['link']."'"));
  $cat = mysql_fetch_array(mysql_query("SELECT Link_Cat FROM kpfw_linkcat WHERE CatID = '".$link['CatID']."'"));
  $user = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$link['UserId']."'"));
  ?>
  <h2>Edit Link</h2><br>
  <?php
  include("admin/menu.php");
  ?>  <center>
    <br><form action="admin.php?page=links&mode=edit" method="post">
    <input type="hidden" name="linkid" value="<?=$_REQUEST['link']?>">
    <b>Link Title:</b> <input type="text" name="linktitle" value="<?=$link['LinkTitle']?>"><br>
    <b>Link Description:</b> <input type="text" name="description" value="<?=$link['LinkDescription']?>"><br>
    <b>Link URL:</b> <input type="text" name="linkurl" value="<?=$link['LinkURL']?>"><br>
    <b>Banner:</b> <input type="text" name="banner" value="<?=$link['Banner']?>"><br>
    <b>Hits:</b> <input type="text" name="hits" size="4" value="<?=$link['Hits']?>"><br>
    <b>Submitting User:</b> <a href="admin.php?page=users&user=<?=$link['UserId']?>" target="_blank"><?=$user['UserName']?></a><br>
    <b>Current Category:</b> <i><a href="admin.php?page=lcat&cat=<?=$link['CatID']?>" target="_blank"><?=$cat['Link_Cat']?></a></i><input type="hidden" name="currcat" value="<?=$link['CatID']?>"><br>
    <input type="checkbox" name="newcat" value="True"> New Category<br>
    <select name="cat"><?php
    $catlist = mysql_query("SELECT * FROM kpfw_linkcat");
    while($newcat = mysql_fetch_array($catlist))
      {
        echo "<option name=\"cat\" value=\"".$newcat['CatID']."\">".$newcat['Link_Cat']."</option>\n";
      }
    ?></select><br>
    <input type="submit" value="Submit"></form>
    <br><br>
    </td>
  </tr>
</table>
    <?php
}
elseif ($_GET['mode'] == "remove"){
  foreach ($_REQUEST['link'] as $link){
    $sql = mysql_query("DELETE FROM kpfw_links WHERE LinkID = '".$link."'");
  }
  header("Location: admin.php?page=links");
}
elseif ($_GET['mode'] == "edit"){
  $linkcat = ($_REQUEST['newcat']) ? $_REQUEST['cat'] : $_REQUEST['currcat'];
  $sql = mysql_query("UPDATE kpfw_links SET LinkTitle = '".$_REQUEST['linktitle']."', LinkDescription = '".$_REQUEST['description']."', Banner = '".$_REQUEST['banner']."', Hits = '".$_REQUEST['hits']."', CatID = '".$linkcat."', LinkURL = '".$_REQUEST['linkurl']."' WHERE LinkID = '".$_REQUEST['linkid']."'");
  header("Location: admin.php?page=links");
}
?>
