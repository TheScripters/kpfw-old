<?php
function print_gallery($where, $what){
  
  	//reads contents of current gallery folder for all the file names
  	
  	//what directory to use
	$dirName = "photogallery/$where/$what";
	
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
	$imageFiles = preg_grep("/jpg$|JPG$/", $theFiles);
	
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
<td><a href = "http://caps.kpfanworld.com/view/$where/$what/$currentFile" target="blank"><img border = "0" alt="$currentFile" src = "http://caps.kpfanworld.com/photogallery/$where/$what/$currentFile" title="Click To View Full Sized Image" /></a></td>	
HERE;
	$picInRow++;
       if ($picInRow == 5){//this controls how many images are in each row, this being set to 5 makes 5 images be in each row
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