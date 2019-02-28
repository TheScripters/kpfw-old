<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys and Brian Wallace
/*******includes/avhost.php******/
include ("db.php");
$avsql = mysql_query("SELECT * FROM kpfw_avhosting WHERE UserId = '".$_SESSION['userID']."'");//gets all of the pictures for each user
$sizes_query = mysql_query("SELECT File_Size FROM kpfw_avhosting WHERE UserId = '".$_SESSION['userID']."'");//gets all the data for the file sizes for the user
$total_size_bytes = 0;
//adds up how much space it used by the user's pictures, and adds up how many pictures they have uploaded
while ($pic_sizes = mysql_fetch_array($sizes_query)){
 $total_size_bytes = $total_size_bytes + $pic_sizes['0'];
 $counter++;
}//end for
$total_size_kbytes = round($total_size_bytes/1024,2);//converts the size of the gallery from bytes to kilobytes
//prints out table of all the pics the user has uploaded
print "<center><br><b>You currently have $counter pictures uploaded</b></center><br><table align=\"center\">";
$picInRow = 1;
while($avatar = mysql_fetch_array($avsql)){
  	$filename = $avatar['AvFilename'];
  	list($width_orig, $height_orig) = getimagesize("hosting/".$_SESSION['UserName']."/$filename");
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
   echo "<img src=\"hosting/".$_SESSION['UserName']."/".$avatar['AvFilename']."\" height=\"$height\" width=\"$width\" ><br>";
   echo "<b>BBCode:</b> <input type=\"text\" value=\"[img]http://www.kpfanworld.com/hosting/".$_SESSION['UserName']."/".$avatar['AvFilename']."[/img]\" onfocus=\"javascript:this.select()\"><br>";
   echo "<b>Direct:</b> <input type=\"text\" value=\"http://www.kpfanworld.com/hosting/".$_SESSION['UserName']."/".$avatar['AvFilename']."\" onfocus=\"javascript:this.select()\">";
   print "<table border = \"0\"><tr>";
   print "<td><form action=\"avhosting_modify.php?mode=delete&pic=".$avatar['AvFilename']."\" method=\"post\"><input type = \"submit\" value =\"Delete\"></form></td>";
   print "<td><form action=\"avhosting_modify.php?mode=modify&pic=".$avatar['AvFilename']."\" method=\"post\"><input type = \"submit\" value =\"Modify\"></form></td></tr></table>";
   echo "</td>";
   $picInRow = $picInRow + 1;
   if ($picInRow == 5){
       echo "  </tr>\n";
       $picInRow = 1;
     }//end if
}//end while
print "</table><br><br>";
print "You have currently used ".$total_size_kbytes."Kb out of 5120Kb";
if ($total_size_kbytes < 5120){//makes sure if the user has not used all their available space
	print "<form action=\"avhosting.php?mode=upload\" method=\"post\" enctype=\"multipart/form-data\">";
	print "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"204800\">";
	print "<input type=\"file\" name=\"avatar\" accept=\"image/jpeg, image/gif, image/png\">&nbsp;&nbsp;<input type=\"submit\" value=\"Upload\"></form><br><br>";
}else{
  Print "You have exceeded you space limit. Please Delete old pictures in order to add new ones";
}//end if
?>