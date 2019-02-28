<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******donate.php***************/
include("includes/functions.php");
incheader("Trivia Game");
include("includes/guides_table.inc");
if (!$_GET['mode']){
	print "<form action=\"triviagame.php?mode=start\" method=\"post\"><br><br>
	<table border=\"0\" align=\"center\">
		<tr>
			<td colspan=\"3\"><center><b><u>Please select the difficulty level (1-3)</u></b></center></td>
		</tr>
		<tr>
			<td><input type=\"radio\" name=\"diff\" value=\"1\">Easy (level 1)</td>
			<td><input type=\"radio\" name=\"diff\" value=\"2\">Medium (level 2)</td>
			<td><input type=\"radio\" name=\"diff\" value=\"3\">Hard (level 3)</td>
		</tr>
		<tr>
			<td colspan=\"3\"><center><input type=\"submit\" value=\"Start!\"></center></td>
		</tr>
	</table>
	</form>";
  
}else if ($_GET['mode']=="start"){
  	if ($_REQUEST['diff']!=""){
		$question_sql_query = (mysql_query("SELECT * FROM kpfw_trivia where Diff_Level = ".$_REQUEST['diff']." ORDER BY RAND() LIMIT 10"));
		$counter=0;
		print "<br><h3>Level ".$_REQUEST['diff']." Questions</h3><form action=\"triviagame.php?mode=grade\" method=\"post\"><table border=\"0\">";
		while ($question_sql = mysql_fetch_array($question_sql_query))
		{
			$ans = $question_sql['Poss_Ans_Full'];
			$ans_id = $question_sql['Poss_Ans'];
		 	//$ans1 = explode(", ",$ans); //this works, but it isn't very efficient
		 	$ans=explode(";", $ans);  //use this instead, it reuses $ans and saves on memory
		 	$ans_id = explode(",", $ans_id);
		
		 	$tmp="";
		 	$index=0;
		
		  	for ($i=0; $i<sizeof($ans); $i++)
			{
		  		$index=rand()%sizeof($ans);
		  		$tmp=$ans[$index];
		  		$ans[$index]=$ans[$i];
		  		$ans[$i]=$tmp;
			}
			$counter++;
			print "<tr><td align=\"center\"><b><u>Question ".$counter.": ".$question_sql['Ques_Text']."</u></td></tr>";
			for($i=0;$i<sizeof($ans);$i++)
		  	{
		    	echo "<tr><td><input type=\"radio\" value=\"".$ans[$i]."&".$question_sql['Ques_ID']."\" name=\"answer".$counter."\"><b>".$ans_id[$i].": ".$ans[$i]."</b></td></tr>";
		  	} 
		  	print "<tr><td><hr width=\"100%\" size=\"2\" color=\"#00FF00\"></td></tr>";
		}
		print "<tr><td><center><input type=\"submit\" value=\"Grade!\"></td></tr></table></form>";
	}else{
	  	print "<form action=\"triviagame.php?mode=start\" method=\"post\"><br><br>
		<table border=\"0\" align=\"center\">
			<tr>
				<td colspan=\"3\"><center><b><u>Please select the difficulty level (1-3)</u></b></center></td>
			</tr>
			<tr>
				<td><input type=\"radio\" name=\"diff\" value=\"1\">Easy (level 1)</td>
				<td><input type=\"radio\" name=\"diff\" value=\"2\">Medium (level 2)</td>
				<td><input type=\"radio\" name=\"diff\" value=\"3\">Hard (level 3)</td>
			</tr>
			<tr>
				<td colspan=\"3\"><center><input type=\"submit\" value=\"Start!\"></center></td>
			</tr>
		</table>
		</form>";
	}
}else if ($_GET['mode']=="grade"){
  print"<br><br><table border=\"0\" align=\"center\">";
  $number_right=0;
  	for($x=1;$x<11;$x++){
  	  	$answer = "answer".$x."";
  	  	if ($_REQUEST[$answer]!=""){
	  	  	$info = explode("&", $_REQUEST[$answer]);
	  	  	$question_sql_query = mysql_fetch_array(mysql_query("SELECT Poss_Ans_Full, Correct_Ans, Ques_Text FROM kpfw_trivia where Ques_ID = $info[1]"));
	  	  	$Poss_Ans = explode(";", $question_sql_query['Poss_Ans_Full']);
	  	  	if ($question_sql_query['Correct_Ans']=="A"){
	  	  	  	$ans_pointer=0;
	  	  	}else if ($question_sql_query['Correct_Ans']=="B"){
	  	  	  	$ans_pointer=1;
	  	  	}else if ($question_sql_query['Correct_Ans']=="C"){
	  	  	  	$ans_pointer=2;
	  	  	}else if ($question_sql_query['Correct_Ans']=="D"){
	  	  	  	$ans_pointer=3;
	  	  	}
	  	  	print "<tr>
						<td>Submitted answer to question ''".$question_sql_query['Ques_Text']."'':</td>
				  <tr>
				  		<td>".stripslashes($info[0])."</td>
				  </tr>";
	  	  	if (stripslashes($info[0])==stripslashes($Poss_Ans[$ans_pointer])){
	  	  	  	print "<tr>
				 		<td><b><font color=\"#00FF00\">You're answer is correct</font></b></td>
				 </tr>
				 <tr>
				 		<td><hr width=\"100%\" size=\"2\" color=\"#00FF00\"></td>
				</tr>";
	  	  	  	$number_right++;
	  	  	}else{
	  	  	  	print "<tr>
						<td><b><font color=\"#FF0000\">You're answer is incorrect, the correct answer is <u>".stripslashes($Poss_Ans[$ans_pointer])."</u></font></b></td>
				</tr>
				<tr>
						<td><hr width=\"100%\" size=\"2\" color=\"#00FF00\"></td>
				</tr>";
	  	  	}
	  	}else{
	  	  print "<tr>
	  	  			<td><font color=\"#FF0000\">Question Not Answered!</font></td>
	  	  		</tr>
				<tr>
				 		<td><hr width=\"100%\" size=\"2\" color=\"#00FF00\"></td>
				</tr>";
	  	}
	}
	$score = 100*round($number_right/10,2);
	print "<tr><td><h3>Your score is ".$score."%</h3></td></tr>
	<tr>
		<td>
			<form action=\"triviagame.php\" method=\"post\">
				<center><input type=\"submit\" value=\"Play Again!\"></center>
			</form>
		</td>
	</tr>
	</table>";
}
footer();
?>
