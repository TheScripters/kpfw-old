<br><br>
<a href="downloads">Back</a>
<?php
print "<table border=\"0\">";
	print print_gallery();
	print "</table></center>";
	
	
function print_gallery(){
	$dirName = "std_cards/thumbs";
	$dp = opendir($dirName);
	//add all files in directory to $theFiles array
	while ($currentFile !== false){
  		$currentFile = readDir($dp);
  		$theFiles[] = $currentFile;
  		sort ($theFiles);
	} // end while
	//extract gif and jpg images
	$imageFiles = preg_grep("/jpg$|JPG$|gif$/", $theFiles);
	$output = "";
	$picInRow = 0;
	foreach ($imageFiles as $currentFile){
	$current_file_jpg = substr($currentFile, 0, strlen($currentFile)-4);
	  if ($picInRow == 0){
           $output .= <<<HERE
<tr>
HERE;
	}//end if
  		$output .= <<<HERE
<td><a href = "std_cards/$current_file_jpg.pdf" target="blank"><img border = "0" alt="$currentFile" src = "std_cards/thumbs/$currentFile" title="Click To View Full Sized"></a></td>	
HERE;
	$picInRow++;
       if ($picInRow == 5){
           $output .= <<<HERE
</tr>\n
HERE;
           $picInRow = 0;
    	}//end if
	} // end foreach
	return $output;
}//end function
print "<center><img src=\"../std_cards/getacro.gif\" alt=\"[image]\"></center><center>";
?>