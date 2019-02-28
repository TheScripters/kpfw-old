<?php
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******includes/avhost.php******/
if (!defined("Admin")){
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
}//end if
if (!isset($_GET['mode'])){
  	print "<h2>Avatar Hosting Managment</h2><br>";
	include("admin/menu.php");
	$users = mysql_query("SELECT DISTINCT UserId FROM kpfw_avhosting");
	$sizes_query = mysql_query("SELECT File_Size FROM kpfw_avhosting");//gets all the data for the file sizes for the user
	$total_size_bytes = 0;
	//adds up how much space it used by the user's pictures, and adds up how many pictures they have uploaded
	while ($pic_sizes = mysql_fetch_array($sizes_query)){
 		$total_size_bytes = $total_size_bytes + $pic_sizes['0'];
	}//end while
	$total_size_kbytes = round($total_size_bytes/1024,2);//converts the size of the gallery from bytes to kilobytes
	$total_size_Mbytes = round($total_size_kbytes/1024,2);
	Print "<center>Total Space Used: ".$total_size_Mbytes."Mb</center><br>";
	$picInRow = 0;
	print "<table border=\"0\" align=\"center\">";
	while($user_id = mysql_fetch_array($users)){
  		$user_name = mysql_fetch_array(mysql_query("select UserName from kpfw_users where UserId = ".$user_id['0'].""));
  		if ($picInRow == 0){
           print "<tr>";
        }//end if
  		print "<td>
  		<form action =\"admin.php?page=avhost&mode=gallery\" method=\"post\">
  		<input type = \"hidden\" name = \"userID\" value = \"".$user_id['0']."\">
   		<input type =\"submit\" value = \"".$user_name['0']."\"><br>
  		</form></td>";
  		$picInRow++;
       	if ($picInRow == 5){
           print "</tr>\n";
           $picInRow = 0;
    	}//end if
	}//end while
	print "</table></td></tr></table>";
}else if ($_GET['mode']== "gallery"){
  	include ("header.inc");
  	print "<h2>Avatar Hosting Managment</h2><br>";
	include("admin/menu.php");
	$avsql = mysql_query("SELECT * FROM kpfw_avhosting WHERE UserId = '".$_REQUEST['userID']."'");//gets all of the pictures for each user
	$user_name = mysql_fetch_array(mysql_query("select UserName from kpfw_users where UserId = '".$_REQUEST['userID']."'"));
	$sizes_query = mysql_query("SELECT File_Size FROM kpfw_avhosting WHERE UserId = '".$_REQUEST['userID']."'");//gets all the data for the file sizes for the user
	$total_size_bytes = 0;
	//adds up how much space it used by the user's pictures, and adds up how many pictures they have uploaded
	while ($pic_sizes = mysql_fetch_array($sizes_query)){
 		$total_size_bytes = $total_size_bytes + $pic_sizes['0'];
 		$counter++;
	}//end while
	$total_size_kbytes = round($total_size_bytes/1024,2);//converts the size of the gallery from bytes to kilobytes
	//prints out table of all the pics the user has uploaded
	print "<center><br><b>User ".$user_name['0']." currently has $counter pictures uploaded</b><br><table border = \"0\">";
	$picInRow = 1;
	while($avatar = mysql_fetch_array($avsql)){
  		$filename = $avatar['AvFilename'];
  		list($width_orig, $height_orig) = getimagesize("hosting/".$user_name['0']."/$filename");
  		if ($height_orig > 200 || $width_orig > 200){
  			$width = 200;
			$height = 200;	
			$ratio_orig = $width_orig/$height_orig;
			if ($width/$height > $ratio_orig) {
   				$width = $height*$ratio_orig;
			} else {
   			$height = $width/$ratio_orig;
   			}//end if
   		} else {
   	  		$width = $width_orig;
	  		$height = $height_orig;
   		}//end if
   		if ($picInRow == 1){
      		echo "  <tr>";
     	}//end if
  		echo "    <td align=\"center\">";
   		echo "<img src=\"hosting/".$user_name['0']."/".$avatar['AvFilename']."\" height=\"$height\" width=\"$width\" ><br>";
   		print "<form action=\"admin.php?page=avhost&mode=confirm_delete\" method=\"post\">
   		  <input type =\"hidden\" name=\"pic\" value =\"".$avatar['AvFilename']."\">
   		  <input type =\"hidden\" name=\"user\" value =\"".$user_name['0']."\">
		  <input type = \"submit\" value =\"Delete\"></form>";
   		echo "</td>";
   		$picInRow = $picInRow + 1;
   		if ($picInRow == 5){
      		 echo "  </tr>\n";
       		$picInRow = 1;
     	}//end if
	}//end while
	print "</table><br><br>";
	print "User ".$user_name['0']." has currently used ".$total_size_kbytes."Kb out of 5120Kb</td></tr></table>";
}else if ($_GET['mode']== "confirm_delete"){
	include ("header.inc");
  	print "<h2>Avatar Hosting Managment</h2><br>";
	include("admin/menu.php");
	print "<center>Confim Delete and User E-mail Message
			<form action=\"admin.php?page=avhost&mode=delete\" method=\"post\">
    		<textarea name = \"user_message\" rows=\"15\" cols=\"50\">
    		</textarea><br><br>
    		<input type =\"hidden\" name=\"pic\" value =\"".$_REQUEST['pic']."\">
   		  	<input type =\"hidden\" name=\"user\" value =\"".$_REQUEST['user']."\">
    		<input type=\"submit\" value =\"Delete\">
    		</form><br></center></td></tr></table>";
}else if ($_GET['mode']== "delete"){
  	$uid = mysql_fetch_array(mysql_query("select UserId from kpfw_users where UserName = '".$_REQUEST['user']."'"));
  	$userinfo = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$uid['0']."'"));
    mail($userinfo['UserEmail'],"KPFW Avatar Hosting","Hello ".$userinfo['UserName'].",\n\nThis email is to inform you that your uploaded picture: ".$_REQUEST['pic']." has been removed from KPFW for the following reason: ".$_REQUEST['user_message']."","Reply-to: staff@kpfanworld.com\nFrom: staff@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
    if (file_exists("/home/kpfanwor/public_html/hosting/".$_REQUEST['user']."/".$_REQUEST['pic']."")){//makes sure the file has not been deleted already, or is missing
		$query = "DELETE from kpfw_avhosting where AvFilename = '".$_REQUEST['pic']."' and UserId = ".$uid['0']."";//deletes entry from database
		$result = mysql_query($query);
		unlink ("/home/kpfanwor/public_html/hosting/".$_REQUEST['user']."/".$_REQUEST['pic']."");//deletes file from server
		header("Location: admin.php?page=avhost");
	}else{
	$query = "DELETE from kpfw_avhosting where AvFilename = '".$_REQUEST['pic']."' and UserId = ".$uid['0']."";
	header("Location: admin.php?page=avhost"); 
	}//end if
}//end if
?>