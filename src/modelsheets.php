<?php
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******modelsheets.php************/
include("includes/functions.php");
incheader("Model Sheets");
include("includes/guides_table.inc");
print "<hr width=\"50%\" size=\"2\" color=\"#00FF00\"><br>Select from the following";

//sees if the use has been to the page before, if not, prints out list of available url's
if ($conn == NULL){
  print "<br><a href=\"modelsheets/kim\">Kim Possible</a> || <a href=\"modelsheets/ron\">Ron Stoppable</a> || <a href=\"modelsheets/mrmrsp\">Kim's Family</a> || <a href=\"modelsheets/wade\">Wade</a> || <a href=\"modelsheets/rufus\">Rufus</a> || <a href=\"modelsheets/mankey\">Josh Mankey</a> || <a href=\"modelsheets/drakken\">Drakken</a> || <a href=\"modelsheets/shego\">Shego</a> || <a href=\"modelsheets/henchman\">Henchman</a> || <a href=\"modelsheets/back\">Background Art</a><br><a href=\"modelsheets/expressions\">Expressions</a> || <a href=\"modelsheets/char\">Misc. Characters</a> || <a href=\"modelsheets/cheer\">Cheerleaders</a> || <a href=\"modelsheets/middlekids\">Kids at Middleton High</a> || <a href=\"modelsheets/props\">Props</a> || <a href=\"modelsheets/locations\">Locations</a> || <a href=\"modelsheets/size\">Size Comparison</a> || <a href=\"modelsheets/misc\">Misc Portfolios</a> || <a href=\"modelsheets/misc2\">Misc</a>";
}//end if
					
//checks to see what mode (ie what url) the user clicked
if ($_GET['mode'] == "kim"){
	print print_sheet("kim", "Kim Possible");
}else if ($_GET['mode'] == "ron"){
	print print_sheet("ron", "Ron Stoppable");
}else if ($_GET['mode'] == "expressions"){
	print print_sheet("expressions", "Expressions");
}else if ($_GET['mode'] == "rufus"){
	print print_sheet("rufus", "Rufus");
}else if ($_GET['mode'] == "wade"){
	print print_sheet("wade", "Wade");
}else if ($_GET['mode'] == "mrmrsp"){
	print print_sheet("mrmrsp", "Kim's Family");
}else if ($_GET['mode'] == "drakken"){
	print print_sheet("drakken", "Drakken");
}else if ($_GET['mode'] == "shego"){
	print print_sheet("shego", "Shego");
}else if ($_GET['mode'] == "henchman"){
	print print_sheet("henchman", "Henchman");
}else if ($_GET['mode'] == "mankey"){
	print print_sheet("mankey", "Josh Mankey");
}else if ($_GET['mode'] == "char"){
	print print_sheet("char", "Misc Characters");
}else if ($_GET['mode'] == "cheer"){
	print print_sheet("cheer", "Cheerleaders");
}else if ($_GET['mode'] == "middlekids"){
	print print_sheet("middlekids", "Kids at Middleton High");
}else if ($_GET['mode'] == "props"){
	print print_sheet("props", "Props");
}else if ($_GET['mode'] == "locations"){
	print print_sheet("locations", "Locations");
}else if ($_GET['mode'] == "size"){
	print print_sheet("size", "Size Comparison");
}else if ($_GET['mode'] == "misc"){
	print print_sheet("port", "Misc Portfolios");
}else if ($_GET['mode'] == "back"){
	print print_sheet("back", "Background Art");
}else if ($_GET['mode'] == "misc2"){
	print print_sheet("misc2", "Misc");
}//end if
//prints out table of modelsheet pics
function print_sheet($who, $name){
	print "<br><h3>$name</h3><br><table border=\"0\">";
		
	$dirName = "images/modelsheets/$who";
	$dp = opendir($dirName);
	//add all files in directory to $theFiles array
	while ($currentFile !== false){
  		$currentFile = readDir($dp);
  		$theFiles[] = $currentFile;
  		sort ($theFiles);
	} // end while

	//extract gif and jpg images
	$imageFiles = preg_grep("/jpg$|gif$/", $theFiles);
	$last_image = end($imageFiles);
	$output = "";
	foreach ($imageFiles as $currentFile){
	  if ($picInRow == 0){
           $output .= <<<HERE
<tr>
HERE;
	}//end if
  		$output .= <<<HERE
<td align="center"><a href = "view_pic/$who/$currentFile">		
  		<img border = "0" src = "images/modelsheets/$who/thumb/$currentFile" alt="[image]" width = "250"></a></td>	
HERE;
	$picInRow++;
       if ($picInRow == 4){
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
	$output .= <<<HERE
	</table>
HERE;
	return $output;
}//end function
footer();
?>


