<?php
include("includes/functions.php");
incheader("Kim's Outfit Guide");
include("includes/guides_table.inc");
if (!$_GET['ep']){
	$photogallery="s1";
	print "<h3><b>Season 1</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="s2";
	print "<h3><b>Season 2</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="s3";
	print "<h3><b>Season 3</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="s4";
	print "<h3><b>Season 4</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "<tr><td colspan=\"4\"><hr width=\"100%\"></td></tr></table>";
	$photogallery="other";
	print "<h3><b>Misc</b></h3><br><table border=\"0\">";
	print print_gallery("$photogallery", "thumb");
	print "</table>";
}else{
  	print "<br><br><a href=\"kim_clothes\">Back</a><br><img src=\"images/kim_clothes/".$_GET['ep']."/".$_GET['pic']."\" alt=\"".$_GET['pic']."\"><br>";
}
footer();



function print_gallery($where, $what){
  
  	//reads contents of current gallery folder for all the file names
  	
  	//what directory to use
	$dirName = "images/kim_clothes/$where/$what";
	
	//opens the directory for reading
	$dp = opendir($dirName)
		or die("<br><font color=\"#FF0000\">Cannot Open The Directory \"images/kim_clothes/$where/$what\" Please make sure the URL was typed correctly. <br>If you think you are revieving this message in error, please e-mail <a href=\"mailto:caps@kpfanworld.com\">Caps@kpfanworld.com</a></font></center></body></html>");
	
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
	$last_image = end($imageFiles);
	//begins printing out the gallery
	$output = "";
	$picInRow = 0;
	foreach ($imageFiles as $currentFile){
	  if ($picInRow == 0){
           $output .= <<<HERE
<tr>
HERE;
	}//end if
  		$output .= <<<HERE
<td align="center"><a href = "kim_clothes/$where/$currentFile"><img border = "0" alt="$currentFile" src = "images/kim_clothes/$where/$what/$currentFile" title="Click To View Full Sized Image"></a></td>	
HERE;
	$picInRow++;
       if ($picInRow == 4){//this controls how many images are in each row, this being set to 5 makes 5 images be in each row
           $output .= <<<HERE
</tr>\n
HERE;
           $picInRow = 0;
       }else{
		  	if ($currentFile == $last_image)
			{
		  	$output .= <<<HERE
</tr>\n
HERE;
			}
    	}//end if
	} // end foreach
	return $output;
}//end function\
?>	