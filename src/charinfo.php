<?php
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******charinfo.php************/
include("includes/functions.php");
$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_charinfo"));//figures out fow many rows there are in the table "charinfo"
$barcount = $count['count'];//gets the actual numerical value

if ($_GET['mode'] == ""){//if the page has not been visited yet
  	incheader("Character Information");
  	include("includes/guides_table.inc");
  	if ($_SESSION['logged_in']){
  		print "<br>Select a Particular Character to Update";
  	}else{
  		print "<br>Please log in if you wish to update the character information";
  	}//end if
  	print "<table border=\"0\" width=\"705\">";
  	//this makes the table. it will use the value of $barcount to make the name number of rows in the table as there are in the "charinfo" table
	for ($i=1; $i <= $barcount; $i++){
  	$charinfo = mysql_fetch_assoc(mysql_query("select * from kpfw_charinfo where id = $i"));//gets all the data from the particular row in "charinfo"
  	//generates the modify button and the last modified by info
	$user = mysql_fetch_array(mysql_query("SELECT user_id FROM kpfw_charinfo WHERE id = $i"));
	$user_name = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = ".$user['0'].""));
  	print "
		<tr>
			<td>
				<center><u><font face=\"Arial Black\" size=\"5\">".$charinfo['name']."</font></u></center></td>
		</tr>
		<tr>
			<td>
			<img alt=\"[image]\" src=\"images/".$charinfo['picture']."\" border=\"0\" align=\"right\">".$charinfo['description']."</td>
		</tr>
		<tr>
			<td height=\"21\" width=\"705\">";
		if ($_SESSION['logged_in']){
	  		print "<a href=\"charinfo/".$i."\">Modify</a>---Last Modified by <a href=\"profile/".$charinfo['user_id']."\">".$user_name['0']."</a><br>
  			==============================================================================</td></tr>";
  		} else{
  		  	print "Last Modified by <a href=\"profile/".$charinfo['user_id']."\">".$user_name['0']."</a><br>==============================================================================</td></tr>";
		}//end if
	}//end for
	print "</table>";
}//end if	
if ($_SESSION['logged_in']){
  	for ($x=1; $x <= $barcount; $x++){
    	if ($_GET['mode'] == $x){
    	  	$charinfo = mysql_fetch_assoc(mysql_query("select * from kpfw_charinfo where id = $x"));
    	  	$orig = $charinfo['description'];
    		incheader("Character Information Update");
    		print "<br><h4>You Selected to Modify ".$charinfo['name']."</h4>
    		<form action=\"charinfo/modify\" method=\"post\">
    		<textarea name = \"description_modify\" rows=\"15\" cols=\"50\">"
    		.$charinfo['description']."
    		</textarea><br><br>
    		<input type=\"hidden\" name=\"who\" value=\"$x\">
    		<input type=\"hidden\" name=\"orig_message\" value=\"$orig\">
    		<input type=\"submit\" value =\"Submit Modification\">
    		</form><br>";
    	}//end if
    }//end for
}//end if
if ($_SESSION['logged_in'] && $_GET['mode'] == "modify"){
  	incheader("Character Information Update");
  	//send an e-mail to the admins about the upadte
    //mail_admin([section, [old entry, [new entry]]]);
    $charinfo = mysql_fetch_assoc(mysql_query("select name from kpfw_charinfo where id = ".$_REQUEST['who'].""));
    if ($_REQUEST['orig_message']== "Null"){
		mail_admin("Info for ".$charinfo['name']."","", $charinfo['name'].": ". clean_it($_REQUEST['description_modify']));
	}else{
		mail_admin("Info for ".$charinfo['name']."",$_REQUEST['orig_message'], $charinfo['name'].": ". clean_it($_REQUEST['description_modify']));
	}//end if
    $sql = mysql_query("UPDATE kpfw_charinfo SET description = '".clean_it($_REQUEST['description_modify'])."' WHERE id = '".$_REQUEST['who']."'");
    $sql = mysql_query("UPDATE kpfw_charinfo SET user_id = '".$_SESSION['userID']."' WHERE id = '".$_REQUEST['who']."'");
    print "<br><h3>Your Changes Have Been Submitted</h3><br><a href=\"charinfo\">Continue</a><br>";
    
    
}//end if
footer();
?>