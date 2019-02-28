<?PHP
error_reporting(E_ALL^E_NOTICE); //stops erros about defined variables
$where = $_GET['ep'];
$pic = $_GET['pic'];
$url_location="http://caps.kpfanworld.com";

//in case the files or folders in the URL have spaces, this will replace them with the needed %20 characters
$address = str_replace(" ", "%20", "caps.kpfanworld.com/images/".$where."/".$pic."");

//tells the header.inc file what to make the title of the page
$episode_page_name = $pic;
include("$url_location/header.inc");
print "
<center>
<a href=\"$url_location/index.php\">Home</a><br /><img border = \"0\" alt=\"The Image you are trying to find couldnot be found. Please make sure the URL was typed correctly. If you think you are revieving this message in error, please e-mail Caps@kpfanworld.com\" src = \"$url_location/images/$where/$pic\" /><br />";
if ($_GET['av']!=""){
  
  	//reads contents of current gallery folder for all the file names
  	
  	//what directory to use
	$dirName = "photogallery/$where/".$_GET['av']."";
	
	//opens the directory for reading
	$dp = opendir($dirName)
		or die("<br /><font color=\"#FF0000\">Cannot Open The Directory \"photogallery/$where/".$_GET['av']."\" Please make sure the URL was typed correctly. <br />If you think you are revieving this message in error, please e-mail <a href=\"mailto:caps@kpfanworld.com\">Caps@kpfanworld.com</a></font></center></body></html>");
	
	//add all files in directory to $theFiles array
	while ($currentFile !== false){
  		$currentFile = readDir($dp);
  		$theFiles[] = $currentFile;
	} // end while
	
	//because we opened the dir, we need to close it
	closedir($dp);
	
	//sorts all the files
	sort ($theFiles);
	//extract gif and jpg images because that is all we wnt to display
	$imageFiles = preg_grep("/jpg$|JPG$|gif$/", $theFiles);
	
	//finds where in the current gallery we are looking at
	$current_pic = array_search($pic, $imageFiles);
	
	//based on where we are in the current gallery, this makes the "Next" and "Previous" image buttns
	
	
	$next5 = $current_pic +5;
	$last5 = $current_pic -5;
	
	$first_previous=$current_pic -1;
	$second_previous=$current_pic -2;
	
	$first_next=$current_pic +1;
	$second_next=$current_pic +2;
	
	($imageFiles[$last5]!="") ? print "<a href=\"$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$last5]."\">Previous 5 Pictures</a>&nbsp;&nbsp;&nbsp;" : print "";
	($imageFiles[$next5]!="") ? print "<a href=\"$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$next5]."\">Next 5 Pictures</a>&nbsp;&nbsp;&nbsp;" : print "";
	print "<br />
	<table border=\"0\" align=\"center\">
		<tr>";
		if($imageFiles[$second_previous]!=""){
			print "<td><a href=\"$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$second_previous]."\"><img src=\"$url_location/photogallery/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$second_previous]."\" border=\"0\" alt=\"".$imageFiles[$second_previous]."\" title=\"Click for Full Version\" /></a></td>";
		}
		if($imageFiles[$first_previous]!=""){
			print "<td><a href=\"$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$first_previous]."\"><img src=\"$url_location/photogallery/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$first_previous]."\" border=\"0\" alt=\"".$imageFiles[$first_previous]."\" title=\"Click for Full Version\" /></a></td>";
		}
		print "<td valign=\"top\"><h2>.:.</h2></td>";
		if($imageFiles[$first_next]!=""){
			print "<td><a href=\"$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$first_next]."\"><img src=\"$url_location/photogallery/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$first_next]."\" border=\"0\" alt=\"".$imageFiles[$first_next]."\" title=\"Click for Full Version\" /></a></td>";
		}
		if($imageFiles[$second_next]!=""){
			print "<td><a href=\"$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$second_next]."\"><img src=\"$url_location/photogallery/".$_GET['ep']."/".$_GET['av']."/".$imageFiles[$second_next]."\" border=\"0\" alt=\"".$imageFiles[$second_next]."\" title=\"Click for Full Version\" /></a></td>";
		}
		print "</tr>
	</table>";
			
		
}//end if
print "
<table border=\"0\">
<tr>
	<th colspan = \"2\">Hot Link Information</th>
</tr>
<tr>
	<td><input type=\"text\" readonly=\"readonly\"  size=\"70\" onfocus=\"javascript:this.select()\" value=\"[img]http://".$address."[/img]\" /></td><td> Forums</td>
</tr>
<tr>
	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"http://".$address."\" /></td><td> Direct</td>
</tr>";
if ($_GET['av']!=""){
  $av = $_GET['av'];
  $address_av = str_replace(" ", "%20", "caps.kpfanworld.com/photogallery/".$where."/".$av."/".$pic."");
  $address_av2 = str_replace(" ", "%20", "$url_location/view/".$_GET['ep']."/".$_GET['av']."/".$pic."");
  print "
  <tr>
  	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"[url=$address_av2][img]http://".$address_av."[/img][/url] ~Click For Full Image\" /></td><td> Linked Thumb</td>
  </tr>
  <tr>
	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"http://".$address_av."\" /></td><td> Avatar</td>
  </tr>";
}//end if
print"
</table>
</center>";
include ("$url_location/footer.inc");
?>