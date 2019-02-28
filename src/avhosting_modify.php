<?PHP
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******avhosting_modify.php************/
include ("includes/functions.php");
if ($_GET['mode'] == "delete"){
	if (file_exists("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/".$_GET['pic']."")){//makes sure the file has not been deleted already, or is missing
		$query = "DELETE from kpfw_avhosting where AvFilename = '".$_GET['pic']."' and UserId = ".$_SESSION['userID']."";//deletes entry from database
		$result = mysql_query($query);
		unlink ("/home/kpfanwor/public_html/hosting/".$_SESSION['UserName']."/".$_GET['pic']."");//deletes file from server
		header("Location: avhosting");
	}else{
	$query = "DELETE from kpfw_avhosting where AvFilename = '".$_GET['pic']."' and UserId = ".$_SESSION['userID']."";
	header("Location: avhosting"); 
	}//end if
}else if ($_GET['mode'] == "modify"){
  incheader("Avatar Hosting");
  print "<br><img src = \"hosting/".$_SESSION['UserName']."/".$_GET['pic']."\" border = \"0\"><br><a href = \"avhosting\"><br>
  		<b><font size=\"4\" face=\"Arial Black\">Back</font></b></a>
  		<table borde = \"0\">
  		<tr align=\"center\">
		  <td>
		  	<form action=\"resize.php?mode=resize\" method=\"post\">
  			<table border = \"1\">
  				<tr>
			  	<th colspan = \"2\">Resize Picture</th>
				</tr>
				<tr>
					<td colspan = \"2\">Warning, resizing will replace existng picture</td>
				</tr>
				<tr>
					<td>Width</td>
					<td><center><input type=\"text\" name=\"width\" value = \"100\"></center></td>
				</tr>
				<tr>
					<td>Height</td>
					<td><center><input type=\"text\" name=\"height\" value = \"100\"></center></td>
				</tr>
				<tr>
					<td><input type=\"hidden\" name=\"picture\" value=\"".$_GET['pic']."\"></td>
				</tr>
				<tr>
					<td colspan = \"2\"><center><input type=\"submit\" value=\"Resize\"></center></td>
				</tr>
			</table>
  			</form>
		  </td>
		  <td>
  			<form action=\"resize.php?mode=rename\" method=\"post\">
  			<table border = \"1\">
  				<tr>
			  	<th colspan = \"2\">Rename Picture</th>
				</tr>
				<tr>
					<td><center><input type=\"text\" name=\"new_name\" value=\"".substr($_GET['pic'], 0, strlen($_GET['pic'])-4)."\"></center></td>
				</tr>
				<tr>
					<td><input type=\"hidden\" name=\"orig_name\" value=\"".$_GET['pic']."\"></td>
				</tr>
				<tr>
					<td><center><input type=\"submit\" value=\"Rename\"></center></td>
				</tr>
			</table>
			<table border =\"0\">
				<tr><td height=\"50\"></td></tr>
			</table>
  			</form>
		  </td>
		  <td>
			<form action=\"resize.php?mode=copy\" method=\"post\">
			<table border=\"1\">
				<tr>
					<th>Copy Picture</th>
				</tr>
				<tr>
					<td><center>New File Name</center></td>
				</tr>
				<tr>
					<td><center><input type=\"text\" name=\"new_name\" value=\"".substr($_GET['pic'], 0, strlen($_GET['pic'])-4)."_copy\"></center></td>
				</tr>
				<tr>
					<td><input type=\"hidden\" name=\"orig_name\" value=\"".$_GET['pic']."\"></td>
				</tr>
				<tr>
					<td><center><input type=\"submit\" value=\"Copy\"></center></td>
			</table>
			<table border =\"0\">
				<tr><td height=\"30\"></td></tr>
			</table>
			</form>
		 </td>
		</tr>
		</table>";
  include ("includes/footer.inc");
}//end if
?>