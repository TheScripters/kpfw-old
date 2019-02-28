<?php
include("includes/functions.php");
if ($_GET['mode'] == ""){
print "<form action=\"emoticon.php?mode=display\" method=\"post\">
<textarea name = \"post_info\"
	rows = 10
	cols = 40>
	</textarea>
<input type =\"submit\"
		value =\"Create Thread\">
</form>";


}else if ($_GET['mode'] =="display"){
	print emoticon($_REQUEST['post_info']);
}//end if


function emoticon($text){
    //$repace_with = " <img src=\"images/emoticons/".$sql_query['replace'].".gif\" border =\"0\" alt =\"[image]\"> ";
    $search = array("::)", ";)", ":D", ";D", ">:(", ":(", ":o", "8-)", "???", ":)", ":P", ":-[", ":-X", ":-/", ":-*");
  	$replace = array(
	  "<img src=\"images/emoticons/10.gif\" border = \"0\" alt =\"[image]\">", 
	  "<img src=\"images/emoticons/2.gif\" border = \"0\" alt =\";)\">", 
	  "<img src=\"images/emoticons/3.gif\" border = \"0\" alt =\":D\">", 
	  "<img src=\"images/emoticons/4.gif\" border = \"0\" alt =\";D\">", 
	  "<img src=\"images/emoticons/5.gif\" border = \"0\" alt =\"[image]\">", 
	  "<img src=\"images/emoticons/6.gif\" border = \"0\" alt =\":(\">", 
	  "<img src=\"images/emoticons/7.gif\" border = \"0\" alt =\":o\">", 
	  "<img src=\"images/emoticons/8.gif\" border = \"0\" alt =\"8-)\">", 
	  "<img src=\"images/emoticons/9.gif\" border = \"0\" alt =\"???\">", 
	  "<img src=\"images/emoticons/1.gif\" border = \"0\" alt =\":)\">", 
	  "<img src=\"images/emoticons/11.gif\" border = \"0\" alt =\":P\">", 
	  "<img src=\"images/emoticons/12.gif\" border = \"0\" alt =\":-[\">", 
	  "<img src=\"images/emoticons/13.gif\" border = \"0\" alt =\":-X\">", 
	  "<img src=\"images/emoticons/14.gif\" border = \"0\" alt =\":-/\">", 
	  "<img src=\"images/emoticons/15.gif\" border = \"0\" alt =\":-*\">");
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}//end function
?>
