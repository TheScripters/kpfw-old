<?PHP
$where = $_GET['ep'];
$pic = $_GET['pic'];
$address = str_replace(" ", "%20", "caps.kpfanworld.com/".$where."/".$pic."");
$episode_page_name = $pic;
include("header.inc");
print "
<center>
<a href=\"http://caps.kpfanworld.com/index.php\">Home</a><br /><img border = \"0\" alt=\"$pic\" src = \"http://caps.kpfanworld.com/$where/$pic\" /><br />";
$no_ex = substr($_GET['pic'], 0, strlen($_GET['pic'])-4);
$image_num = substr($_GET['pic'], 5, strlen($_GET['pic'])-9);
$prev5 = $image_num - 5;
$next5 = $image_num + 5;

$first_previous=$image_num - 1;
$second_previous=$image_num - 2;
	
$first_next=$image_num + 1;
$second_next=$image_num + 2;
	
(file_exists("caps/Image".$prev5.".jpg")) ? print "<a href=\"http://caps.kpfanworld.com/view/std/Image".$prev5.".jpg\">Previous 5 Images</a>&nbsp;&nbsp;&nbsp;" : print "";
(file_exists("caps/Image".$next5.".jpg")) ? print "<a href=\"http://caps.kpfanworld.com/view/std/Image".$next5.".jpg\">Next 5 Images</a>" : print "";
print "<table border=\"0\" align=\"center\">
		<tr>";
		if(file_exists("caps/Image".$second_previous.".jpg")){
			print "<td><a href=\"http://caps.kpfanworld.com/view/std/Image".$second_previous.".jpg\"><img src=\"http://caps.kpfanworld.com/cap_thumbs/Image".$second_previous.".jpg\" border=\"0\" alt=\"Image".$second_previous.".jpg\" title=\"Click for Full Version\" /></a></td>";
		}
		if(file_exists("caps/Image".$first_previous.".jpg")){
			print "<td><a href=\"http://caps.kpfanworld.com/view/std/Image".$first_previous.".jpg\"><img src=\"http://caps.kpfanworld.com/cap_thumbs/Image".$first_previous.".jpg\" border=\"0\" alt=\"Image".$first_previous.".jpg\" title=\"Click for Full Version\" /></a></td>";
		}
		print "<td valign=\"top\"><h2>.:.</h2></td>";
		if(file_exists("caps/Image".$first_next.".jpg")){
			print "<td><a href=\"http://caps.kpfanworld.com/view/std/Image".$first_next.".jpg\"><img src=\"http://caps.kpfanworld.com/cap_thumbs/Image".$first_next.".jpg\" border=\"0\" alt=\"Image".$first_next.".jpg\" title=\"Click for Full Version\" /></a></td>";
		}
		if(file_exists("caps/Image".$second_next.".jpg")){
			print "<td><a href=\"http://caps.kpfanworld.com/view/std/Image".$second_next.".jpg\"><img src=\"http://caps.kpfanworld.com/cap_thumbs/Image".$second_next.".jpg\" border=\"0\" alt=\"Image".$second_next.".jpg\" title=\"Click for Full Version\" /></a></td>";
		}
		print "</tr>
	</table>";




print "
<table border=\"0\">
<tr>
	<th colspan = \"2\">Hot Link Information</th>
</tr>
<tr>
	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"[img]http://".$address."[/img]\" /></td><td> Forums</td>
</tr>
<tr>
	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"http://".$address."\" /></td><td> Direct</td>
</tr>";
$av = $_GET['av'];
  $address_av = str_replace(" ", "%20", "caps.kpfanworld.com/cap_thumbs/".$pic."");
  print "
  <tr>
  	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"[url=http://".$address."][img]http://".$address_av."[/img][/url] ~Click For Full Image\" /></td><td> Linked Thumb</td>
  </tr>
  <tr>
	<td><input type=\"text\" readonly=\"readonly\" size=\"70\" onfocus=\"javascript:this.select()\" value=\"http://".$address_av."\" /></td><td> Avatar</td>
  </tr>
</table>
</center>";
include ("footer.inc");
?>