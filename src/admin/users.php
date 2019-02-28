<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/users.php**********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
if (!$_REQUEST['user'] && !$_GET['mode'])
  {
    echo "<h2>User Management</h2><br>\n";
    include("admin/menu.php");
    echo "<center><br><form action=\"admin.php?page=users\" method=\"post\">\n";
    echo "<h3>Modify User</h3>\n";
    echo "<b>User Name:</b> <input type=\"text\" name=\"user\"><br>\n";
    echo "<input type=\"submit\" value=\"Manage\"></form><br><br>\n";
    echo "<form action=\"admin.php?page=users&mode=delete\" method=\"post\">\n";
    echo "<h3>Delete User</h3>\n";
    echo "<b>User Name:</b> <input type=\"text\" name=\"UserName\"><br>\n";
    echo "<input type=\"submit\" value=\"Delete\"></form>\n";
  }
 elseif ($_REQUEST['user'] && !$_GET['mode'])
  {
    $userinfo = mysql_fetch_array(mysql_query("SELECT UserId,UserName,Name,UserEmail,Active,Act_Key,IP_Login FROM kpfw_users WHERE UserName = '".$_REQUEST['user']."'"));
    $Active = ($userinfo['Active'] == "1") ? " CHECKED" : "";
    ?>
<h2>Editing <?=$userinfo['UserName']?></h2><br>
<?include("admin/menu.php");?><center>
<form action="admin.php?page=users&mode=edit" method="post">
<input type="hidden" name="userid" value="<?=$userinfo['UserId']?>">
<b>User Name:</b> <input type="text" name="username" value="<?=$userinfo['UserName']?>"><br>
<b>User Email:</b> <input type="text" name="useremail" value="<?=$userinfo['UserEmail']?>"><br>
<b>Name:</b> <input type="text" name="name" value="<?=$userinfo['Name']?>"><br><hr width="50%" size="2" color="lime">
<b>Password:</b> <input type="password" name="password"><br>
<b>Confirm:</b> <input type="password" name="confpwd"><br><hr width="50%" size="2" color="lime">
<input type="checkbox" name="Active" value="true"<?=$Active?>> Active<br>
<b>Activation Key</b> <input type="text" name="actkey" value="<?=$userinfo['Act_Key']?>"><br>
<b>Last login from:</b> <i><?=$userinfo['IP_Login']?></i><br>
<input type="submit" value="Submit"></form>
    <?php
  }
if ($_GET['mode'] == "edit")
  {
    if ($_REQUEST['password'])
      {
        if ($_REQUEST['password'] != $_REQUEST['confpwd'])
          {
            $userinfo = mysql_fetch_array(mysql_query("SELECT UserId,UserName,Name,UserEmail,Active,Act_Key FROM kpfw_users WHERE UserId = '".$_REQUEST['userid']."'"));
            $Active = ($_REQUEST['Active'] == "true") ? " CHECKED" : "";
            ?>
<br><h2>Editing <?=$_REQUEST['username']?></h2><br>
<?include("admin/menu.php");?><center>
<b>Passwords do not match!</b><br><br>
<form action="admin.php?page=users&mode=edit" method="post">
<input type="hidden" name="userid" value="<?=$_REQUEST['userid']?>">
<b>User Name:</b> <input type="text" name="username" value="<?=$_REQUEST['username']?>"><br>
<b>User Email:</b> <input type="text" name="useremail" value="<?=$_REQUEST['useremail']?>"><br>
<b>Name:</b> <input type="text" name="name" value="<?=$_REQUEST['name']?>"><br><hr><br>
<b>Password:</b> <input type="password" name="password"><br>
<b>Confirm:</b> <input type="password" name="confpwd"><br><hr><br>
<input type="checkbox" name="Active" value="true"<?=$Active?>> Active<br>
<b>Activation Key</b> <input type="text" name="actkey" value="<?=$_REQUEST['actkey']?>"><br>
<input type="submit" value="Submit"></form>
            <?php
          }
         else
          {
            $Active = ($_REQUEST['Active'] == "true") ? "1" : "0";
            $activedif = mysql_fetch_array(mysql_query("SELECT Active FROM kpfw_users WHERE UserId = '".$_REQUEST['userid']."'"));
            $sql = mysql_query("UPDATE kpfw_users SET UserName = '".$_REQUEST['username']."', UserEmail = '".$_REQUEST['useremail']."', Name = '".$_REQUEST['name']."', Act_Key = '".$_REQUEST['actkey']."', Active = '".$Active."', Password = '".md5($_REQUEST['password'])."' WHERE UserId = '".$_REQUEST['userid']."'");
            ($Active != $activedif['Active']) ? mail_user($_REQUEST['userid'],$Active) : "";
            header("Location: admin.php?page=users");
          }
      }
     else
      {
        $Active = ($_REQUEST['Active'] == "true") ? "1" : "0";
        $activedif = mysql_fetch_array(mysql_query("SELECT Active FROM kpfw_users WHERE UserId = '".$_REQUEST['userid']."'"));
        $sql = mysql_query("UPDATE kpfw_users SET UserName = '".$_REQUEST['username']."', UserEmail = '".$_REQUEST['useremail']."', Name = '".$_REQUEST['name']."', Act_Key = '".$_REQUEST['actkey']."', Active = '".$Active."' WHERE UserId = '".$_REQUEST['userid']."'");
        ($Active != $activedif['Active']) ? mail_user($_REQUEST['userid'],$Active) : "";
        header("Location: admin.php?page=users");
      }
  }
 elseif ($_GET['mode'] == "delete"){
   if (file_exists("/home/kpfanwor/public_html/hosting/".$_REQUEST['UserName'].""))
   {
	   $user_id = mysql_fetch_array(mysql_query("SELECT UserId FROM kpfw_users WHERE UserName = '".$_REQUEST['UserName']."'"));
	   $user_hosted_files_sql = mysql_query("SELECT AvFilename FROM kpfw_avhosting WHERE UserId = '".$user_id['UserId']."'");
	   while ($user_hosted_files = mysql_fetch_array($user_hosted_files_sql))
	   {
	    	if (file_exists("/home/kpfanwor/public_html/hosting/".$_REQUEST['UserName']."/".$user_hosted_files['AvFilename'].""))
			{
				unlink("/home/kpfanwor/public_html/hosting/".$_REQUEST['UserName']."/".$user_hosted_files['AvFilename']."");
				$sql = mysql_query("DELETE FROM kpfw_avhosting WHERE AvFilename = '".$user_hosted_files['AvFilename']."' and UserId = '".$user_id['UserId']."'");
			}//end if
	   }//end while
	   rmdir("/home/kpfanwor/public_html/hosting/".$_REQUEST['UserName']."");
	}//end if
   $sql = mysql_query("DELETE FROM kpfw_users WHERE UserName = '".$_REQUEST['UserName']."'");
   header("Location: admin.php?page=users");
 }
?>
</center>
    </td>
  </tr>
</table>
