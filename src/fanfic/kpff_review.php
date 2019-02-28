<?php
// Code © 2006 KPFanWorld.com
// Code written by Brian Wallace
/*******kpfw_forum.php************/
include("includes/functions.php");
incheader("KPFF Story Review");
//gets the current user's time zome from their profile to addjust the time stamps to their timezone
if ($_SESSION['logged_in']){
	$user_time_zone = mysql_fetch_array(mysql_query("SELECT Time_Zone FROM kpfw_users WHERE UserId = ".$_SESSION['userID'].""));
}else{
  $user_time_zone = -0.00;
}//end if
$timenow = time();
$timezone = 3600*($user_time_zone['0']);
if (!$_GET['mode']){
  $ficTitle = mysql_fetch_array(mysql_query("SELECT Title FROM kpfw_fftitles WHERE FF_Id = '".$_GET['ficID']."'"));
$story_title_userID = mysql_fetch_array(mysql_query("SELECT ChapterTitle, UserID FROM kpfw_ffchapter where FicId = ".$_GET['ficID']." and Chapter = ".$_GET['chap'].""));
$author_info = mysql_fetch_array(mysql_query("SELECT UserName, UserEmail, ShowEmail FROM kpfw_users WHERE UserId = ".$story_title_userID['UserID'].""));
print "<form action=\"kpff_review.php?mode=post\" method=\"post\">
	<table border = \"0\" align =\"center\">
    <tr>
		<td align=\"center\"><h2 style=\"margin-bottom:5px\">".$ficTitle['Title']."</h2>
        <h4 style=\"margin-top:5px;margin-bottom:10px\">".$story_title_userID['ChapterTitle']."</h2></td>
	</tr>
	<tr>
		<td align=\"center\"><h3>By ".$author_info['UserName']."</h3></td>
	</tr>
	<tr>
		<td align =\"center\">Rating: 
			<input type = \"radio\"
				name = \"rating\"
				value = \"1\"><img src=\"images/1star.JPG\" ATL=\"1 Star\">
			<input type = \"radio\"
				name = \"rating\"
				value = \"2\"><img src=\"images/2star.jpg\" ATL=\"2 Star\">
			<input type = \"radio\"
				name = \"rating\"
				value = \"3\"><img src=\"images/3star.jpg\" ATL=\"3 Star\">
			<input type = \"radio\"
				name = \"rating\"
				value = \"3\"><img src=\"images/4star.jpg\" ATL=\"4 Star\">
			<input type = \"radio\"
				name = \"rating\"
				value = \"5\"><img src=\"images/5star.jpg\" ATL=\"5 Star\">
		</td>
	</tr>
	<tr>
		<td align =\"center\"><b>User Review</b></td>
	</tr>
	<tr>
		<td align =\"center\">
<textarea name = \"user_review\"
	rows = 10
	cols = 40>
</textarea><br>
			<input type =\"submit\"
				value =\"Submit\">
		</td>
	</tr>
	</table>
	<input type=\"hidden\"
		name=\"ficid\"
		value = \"".$_GET['ficID']."\">
	<input type=\"hidden\"
		name=\"chap\"
		value = \"".$_GET['chap']."\">
	</form>";
}else if ($_GET['mode']=="post"){

}//end if
footer();
?>
