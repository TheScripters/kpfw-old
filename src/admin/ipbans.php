<?php
// Code © 2006 KPFanWorld.com
// Code written By Adam Humpherys
/*******admin/ipbans.php*********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_GET['mode']){
  ?>
  <h2>IP Banning</h2><br>
  <?php
  include("admin/menu.php");
  ?>  <center>
    <br><form action="admin.php?page=ipbans&mode=remove" method="post">
    <h3>Remove bans</h3>
    <select name="ipaddress[]" size="6" multiple>
    <?php
    $iplstsql = mysql_query("SELECT * FROM kpfw_ip_bans");
    while($iplist = mysql_fetch_array($iplstsql))
      {
        echo "    <option name=\"ipaddress\" value=\"".$iplist['BanID']."\">".$iplist['Ban_IP']."</option>\n";
      }
    ?>
    </select><br>
    <input type="submit" value="Submit"></form>
    <br><br>
    <form action="admin.php?page=ipbans&mode=add" method="post">
    <h3>Add Ban</h3>
    <b>IP Address:</b> <input type="text" name="ipaddress" maxlength="15"><br>
    <input type="submit" value="Submit"></form>
    </td>
  </tr>
</table>
<?php
}
elseif ($_GET['mode'] == "remove"){
  foreach($_REQUEST['ipaddress'] as $banrem)
    {
      $sql = mysql_query("DELETE FROM kpfw_ip_bans WHERE BanID = '".$banrem."'");
    }
  header("Location: admin.php?page=ipbans");
}
elseif ($_GET['mode'] == "add"){
  $sql = mysql_query("INSERT INTO kpfw_ip_bans VALUES (NULL, '".$_REQUEST['ipaddress']."')");
  header("Location: admin.php?page=ipbans");
}
?>
