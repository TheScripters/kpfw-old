<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/member.php*********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
?>
<h2>Member List</h2><br>
<?php
include("admin/menu.php"); 
	$membercount = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS memcnt FROM kpfw_users"));
      if ($membercount['memcnt'] >= 31 && $_GET['pagenum'])
        {
          $multiplier = $_REQUEST['pagenum'] - 1;
          $page = 30*$multiplier;
        }
       else
        {
          $page = 0;
        }
       $pagenum = (!$_GET['pagenum']) ? 1 : $_GET['pagenum'];  
	print "<form action=\"admin.php?page=member&pagenum=".$_GET['pagenum']."\" method=\"post\">";
?> 
	<center>Sort By: 
	<select name = "lstorderby"
		<option value = "namedown">User Name Descending</option>
		<option value = "nameup">User Name Ascending</option>
		<option value = "joindatedown">Join Date Descending</option>
		<option value = "joindateup">Join Date Ascending</option>
		<option value = "useriddown">User ID Descending</option>
		<option value = "useridup">User ID Ascending</option>
	</select>
	<input type = "submit"
		value = "Submit">
	</center>
	</form>
	<?php
	print "<form action=\"admin.php?page=member\" method=\"post\">";
?> 
	<br>
	<center>Search: <input type="text" name="keyword"> by 
	<select name = "search"
		<option value = "UserName">User Name</option>
		<option value = "UserEmail">User E-mail</option>
		<option value = "Name">Name</option>
		<option value = "IP_Login">IP Address</option>
		<option value = "Act_Key">Activation Key</option>
		<option value = "Active">Active? 1 or 0</option>
	</select>
	<input type = "submit"
		value = "Submit">
	</center>
	</form>
	<table align="center" rules="rows">
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Name</th>
        <th>Join Date</th>
        <th>Last IP</th>
        <th>Active</th>
        <th>Key</th>
        <th>User Level</th>
      </tr>
      <?php
       $range = ceil($membercount['memcnt'] / 30);
      if (!$_REQUEST['lstorderby']){
         if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY UserId ASC LIMIT $page,30");
	     }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }else if ($_REQUEST['lstorderby']=="namedown"){
	     if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY UserName desc LIMIT $page,30");
	     }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }else if ($_REQUEST['lstorderby']=="nameup"){
	     if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY UserName ASC LIMIT $page,30");
	     }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }else if ($_REQUEST['lstorderby']=="joindatedown"){
	     if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY Joined_Date desc LIMIT $page,30"); 
		 }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }else if ($_REQUEST['lstorderby']=="joindateup"){
	     if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY Joined_Date ASC LIMIT $page,30");
		 }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }else if ($_REQUEST['lstorderby']=="useriddown"){
	     if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY UserId desc LIMIT $page,30"); 
		 }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }else if ($_REQUEST['lstorderby']=="useridup"){
	     if(!$_REQUEST['search']){
	     	$memberlist = mysql_query("SELECT * FROM kpfw_users ORDER BY UserId ASC LIMIT $page,30"); 
	    }else{
	       $memberlist = mysql_query("select * from kpfw_users WHERE ".$_REQUEST['search']." LIKE '%".$_REQUEST['keyword']."%'");
	     }
	     
	   }//end if    
       while($list = mysql_fetch_array($memberlist))
         {
           $joined = gmdate("M d Y",$list['Joined_Date']+$list['Time_Zone']);
           echo "<tr><td align=\"center\"><a href=\"admin.php?page=users&user=".$list['UserName']."\" title=\"Modify\">".$list['UserName']."</a></td>\n";
           echo "<td align=\"center\">".$list['UserEmail']."</td>\n";
           echo "<td align=\"center\">".$list['Name']."</td>\n";
           echo "<td align=\"center\">".$joined."</td>\n";
           echo "<td align=\"center\">".$list['IP_Login']."</td>\n";
           echo "<td align=\"center\">".$list['Active']."</td>\n";
           echo "<td align=\"center\">".$list['Act_Key']."</td>\n";
           echo "<td align=\"center\">".$list['UserLevel']."</td></tr>\n";
         }
       $next = ($_GET['pagenum'] >= 2) ? $_GET['pagenum']+1 : 2;
       echo "<tr><td align=\"left\" colspan=\"2\">";
       ($_GET['pagenum'] >= 2) ? print "<a href=\"admin.php?page=member&pagenum=".$multiplier."\">Previous Page</a>" : "";
       echo "</td><td align=\"center\" colspan=\"4\">";
       for ($i=1;$i<=$range;$i++)
         {
           $j = ($i != $range) ? "&nbsp;&nbsp;" : "";
           if ($i == $pagenum){
             echo $i.$j;
           } else {
             echo "<a href=\"admin.php?page=member&pagenum=".$i."\">".$i."</a>".$j;
           }
         }
       echo "</td><td align=\"right\" colspan=\"2\">";
       ($membercount['memcnt'] >= $page+30) ? print "<a href=\"admin.php?page=member&pagenum=".$next."\">Next Page</a>" : "";
       echo "</td></tr>";
      ?>
    </table>
    </td>
  </tr>
</table>
