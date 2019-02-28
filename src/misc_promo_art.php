<?php
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******modelsheets.php************/
include("includes/functions.php");
incheader("Misc Promo Art");
include("includes/guides_table.inc");
if (!$_GET['mode']){
	print "<br><br><table border=\"0\">";
	print print_gallery();
	print "</table>";
footer();		
}
		
function print_gallery(){
	$dirName = "images/misc_promotional_art/thumb";
	$dp = opendir($dirName);
	//add all files in directory to $theFiles array
	while ($currentFile !== false){
  		$currentFile = readDir($dp);
  		$theFiles[] = $currentFile;
	} // end while
	sort ($theFiles);
	//extract gif and jpg images
	$imageFiles = preg_grep("/jpg$|JPG$|gif$/", $theFiles);
	$last_image = end($imageFiles);
	$output = "";
	$picInRow = 0;
	foreach ($imageFiles as $currentFile){
	  if ($picInRow == 0){
           $output .= <<<HERE
<tr>
HERE;
	}//end if
  		$output .= <<<HERE
<td align="center"><a href = "misc_promo_art/view/$currentFile">		
  		<img border = "0" src = "images/misc_promotional_art/thumb/$currentFile" alt="[image]"></a></td>	
HERE;
	$picInRow++;
       if ($picInRow == 2){
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
}
if ($_GET['mode'] == "view"){
  print "<br><br><center><a href = \"misc_promo_art\">Back</a><br><br><img border = \"0\" src = \"images/misc_promotional_art/".$_REQUEST['pic']."\" atl=\"".$_REQUEST['pic']."\"><br><br>";
  print "</center>";
  footer();
}
?>


