<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******epguides.php*************/
include("includes/functions.php");
// "mode" variable not used in page URL
if (!isset($_GET['mode']))
  {
    // Include header.inc and set page title
    incheader("Episode Guides");
    echo "<a name=\"top\"></a>";
    include("includes/guides_table.inc");
    $next_ep = $_GET['ep'] + 1;//creates variable for next episode
    $last_ep = $_GET['ep'] - 1;//creates variable for previous episode
    if ($_GET['ep'] == 1){
      	$ep_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_eplist"));//gets the total number of episodes
		$epcount = $ep_count['count'];//gets the actual numerical value
        $last_ep = $epcount;
    }//end if
    // "ep" variable is used, but valus is not "movie" and "id" variable is not used
    if (isset($_GET['ep']) && $_GET['ep'] != "movie" && !isset($_GET['id']))
      {
        // Single episode selected, show information for that episode
        // Request database information
        $epinfo1 = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_eplist WHERE EpId = '".$_GET['ep']."'"));
        $epinfo2 = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_epguide WHERE EpId = '".$_GET['ep']."'"));
        //creates navigation variables to last and next pages
        // Begin Page output
        // Top of page -- Episode title
        echo "<h2>".strip_gpc_slashes($epinfo1['EpTitle'])."</h2>\n";
        echo "<table border = 0><tr><td><a href=\"guides/$last_ep\"><img border=\"0\" src=\"images/previous.jpg\" alt=\"Previous Episode\"></a></td><td width=\"60%\"></td><td><a href=\"guides/$next_ep\"><img border=\"0\" src=\"images/next.jpg\" alt=\"Next Episode\"></a></td></tr></table>";
        echo "<br><table align=\"center\" width=\"75%\" border=\"1\" rules=\"rows\">\n";
        echo "<tr><th>Basic Information:</th>";
		echo "<tr><td><br><table width=\"100%\"><tr><th align=\"right\" valign=\"top\">Description:</th><td>".strip_gpc_slashes($epinfo1['EpDesc'])." || <a href=\"recap/".$_GET['ep']."\">Episode Recap</a> || <a href=\"transcript/".$_GET['ep']."\">Episode Transcript</a></td></tr>";
        echo "<tr><td colspan=\"2\" align=\"center\"><b>Director:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($epinfo2['Director']);
        echo " | <b>Writer:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($epinfo2['Writer']);
        echo " | <b>Producer:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($epinfo2['Producer']);
        echo "<br><b>Studio:</b> ".$epinfo2['Studio']." | <b>Executive Producer:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($epinfo2['Executive']);
        echo "</td></tr>";
        echo "<tr><td colspan=\"2\" align=\"center\"><b>Air Date:</b> ".$epinfo1['AirDate']." | <b>Season:</b> ".$epinfo1['Season']." | <b>Production Number:</b> ".$epinfo1['ProdId']."</td></tr></table></td></tr>";
        echo "<tr><th>Cast:</th></tr>";
        echo "<tr><td align=\"center\"><b>Regular Cast:</b> ";
        $stars = mysql_fetch_array(mysql_query("SELECT Stars FROM kpfw_epguide WHERE EpId = '".$_GET['ep']."'"));
        crew_imdb($stars['Stars']);
        echo "<br>";
        if ($_SESSION['logged_in']){
          echo "<br><form action=\"guide.php?mode=edit\" method=\"post\">\n";
          echo "<input type=\"hidden\" name=\"type\" value=\"stars\">\n";
          echo "<input type=\"hidden\" name=\"ep\" value=\"".$_GET['ep']."\">";
          echo "<input type=\"submit\" value=\"Edit Stars\"></form><br>";
        }
        echo "<br><b>Guest Stars:</b> ";
        $guest = mysql_fetch_array(mysql_query("SELECT GuestStars FROM kpfw_epguide WHERE EpId = '".$_GET['ep']."'"));
        crew_imdb($guest['GuestStars']);
        echo "<br>";
        if ($_SESSION['logged_in']){
          echo "<br><form action=\"guide.php?mode=edit\" method=\"post\">\n";
          echo "<input type=\"hidden\" name=\"type\" value=\"guests\">\n";
          echo "<input type=\"hidden\" name=\"ep\" value=\"".$_GET['ep']."\">";
          echo "<input type=\"submit\" value=\"Edit Guest Stars\"></form><br>";
        }
        echo "<br>";
        if ($_SESSION['logged_in']){
          echo "<form action=\"guide.php?mode=add&type=stars\" method=\"post\">\n";
          echo "<select name=\"stars\"><option name=\"stars\" value=\"regular\">Regular Cast</option>\n<option name=\"stars\" value=\"guest\">Guest Stars</option></select>";
          echo "&nbsp;&nbsp;<input type=\"text\" name=\"newcast\"><br><input type=\"submit\" value=\"Submit\"><input type=\"hidden\" value=\"".$_GET['ep']."\" name=\"ep\"></form>";
        }
        echo "<tr><th>Notes:</th></tr>";
        echo "<tr><td align=\"center\"><table align=\"center\" width=\"50%\">";
        // Request Notes from database
        $notesql = mysql_query("SELECT NoteId,NoteText,UserId FROM kpfw_epnotes WHERE EpId = '".$_GET['ep']."'");
        // Note loop
        while($note = mysql_fetch_array($notesql))
          {
            $usern = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$note['UserId']."'"));
            // Change newlines to HTML line break, parse BBCode
            echo "<tr><td>".nl2br(bbcode($note['NoteText']))."<br>-<a href=\"profile/".$note['UserId']."\">".$usern['UserName']."</a></td></tr>";
            if ($_SESSION['userID'] == $note['UserId'] || $_SESSION['UserLevel'] == "3"){
              echo "<tr><td align=\"right\"><form action=\"guide.php?mode=edit\" method=\"post\">\n";
              echo "<input type=\"hidden\" name=\"type\" value=\"note\">";
              echo "<input type=\"hidden\" name=\"note\" value=\"".$note['NoteId']."\">\n";
              echo "<input type=\"submit\" value=\"Edit\"></form></td></tr>";
            }
            echo "<tr><td height=\"10\"></td></tr>";
          }
        echo "</table><br>";
        if ($_SESSION['logged_in']){
          echo "<form action=\"guide.php?mode=add&type=notes\" method=\"post\">\n";
          echo "<textarea rows=\"3\" cols=\"40\" name=\"note\"></textarea><input type=\"hidden\" value=\"".$_GET['ep']."\" name=\"ep\"><br><input type=\"submit\" value=\"Submit\"></form>";
        }
        echo "</td></tr>";
        echo "<tr><th>Quotes:</th></tr>";
        echo "<tr><td align=\"center\"><table align=\"center\" width=\"50%\">";
        // Request Quotes from databse
        $quotesql = mysql_query("SELECT QuoteID,QuoteText,UserId FROM kpfw_quotes WHERE EpId = '".$_GET['ep']."'");
        // Quote loop
        while($quote = mysql_fetch_array($quotesql))
          {
            $userq = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$quote['UserId']."'"));
            // Change newlines to HTML line break, parse BBCode
            echo "<tr><td>".nl2br(bbcode($quote['QuoteText']))."<br>-<a href=\"profile/".$quote['UserId']."\">".$userq['UserName']."</a></td></tr>";
            if ($_SESSION['userID'] == $quote['UserId'] || $_SESSION['UserLevel'] == "3"){
              echo "<tr><td align=\"right\"><form action=\"guide.php?mode=edit\" method=\"post\">\n";
              echo "<input type=\"hidden\" name=\"type\" value=\"quote\">";
              echo "<input type=\"hidden\" name=\"quote\" value=\"".$quote['QuoteID']."\">\n";
              echo "<input type=\"submit\" value=\"Edit\"></form></td></tr>";
            }
            echo "<tr><td height=\"10\"></td></tr>";
          }
        echo "</table>";
        if ($_SESSION['logged_in']){
          echo "<form action=\"guide.php?mode=add&type=quotes\" method=\"post\">\n";
          echo "<textarea rows=\"3\" cols=\"40\" name=\"quote\"></textarea><input type=\"hidden\" value=\"".$_GET['ep']."\" name=\"ep\"><br><input type=\"submit\" value=\"Submit\"></form>";
        }
        echo "</td></tr>";
        echo "<tr><th>Goofs:</th></tr>";
        echo "<tr><td align=\"center\"><table align=\"center\" width=\"50%\">";
        // Request Goofs from the database
        $goofsql = mysql_query("SELECT GoofID,GoofText,UserId FROM kpfw_goofs WHERE EpId = '".$_GET['ep']."'");
        // Goof loop
        while($goof = mysql_fetch_array($goofsql))
          {
            $userg = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$goof['UserId']."'"));
            // Change newlines to HTML line break, parse BBCode
            echo "<tr><td>".nl2br(bbcode($goof['GoofText']))."<br>-<a href=\"profile/".$goof['UserId']."\">".$userg['UserName']."</a></td></tr>";
            if ($_SESSION['userID'] == $goof['UserId'] || $_SESSION['UserLevel'] == "3"){
              echo "<tr><td align=\"right\"><form action=\"guide.php?mode=edit\" method=\"post\">\n";
              echo "<input type=\"hidden\" name=\"type\" value=\"goof\">";
              echo "<input type=\"hidden\" name=\"goof\" value=\"".$goof['GoofID']."\">\n";
              echo "<input type=\"submit\" value=\"Edit\"></form></td></tr>";
            }
            echo "<tr><td height=\"10\"></td></tr>";
          }
        echo "</table>";
        if ($_SESSION['logged_in']){
          echo "<form action=\"guide.php?mode=add&type=goofs\" method=\"post\">\n";
          echo "<textarea rows=\"3\" cols=\"40\" name=\"goof\"></textarea><input type=\"hidden\" value=\"".$_GET['ep']."\" name=\"ep\"><br><input type=\"submit\" value=\"Submit\"></form>";
        }
        echo "</td></tr>";
        echo "<tr><th>Cultural References:</th></tr>";
        echo "<tr><td align=\"center\"><table align=\"center\" width=\"50%\">";
        // Request Cultural References
        $cultsql = mysql_query("SELECT CultId,CulturalText,UserId FROM kpfw_cultural WHERE EpId = '".$_GET['ep']."'");
        // Cultural Reference loop
        while($cultural = mysql_fetch_array($cultsql))
          {
            $userc = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$cultural['UserId']."'"));
            // Change newlines to HTML line break, parse BBCode
            echo "<tr><td>".nl2br(bbcode($cultural['CulturalText']))."<br>-<a href=\"profile/".$cultural['UserId']."\">".$userc['UserName']."</a></td></tr>";
            if ($_SESSION['userID'] == $cultural['UserId'] || $_SESSION['UserLevel'] == "3"){
              echo "<tr><td align=\"right\"><form action=\"guide.php?mode=edit\" method=\"post\">\n";
              echo "<input type=\"hidden\" name=\"type\" value=\"cultural\">";
              echo "<input type=\"hidden\" name=\"cultural\" value=\"".$cultural['CultId']."\">\n";
              echo "<input type=\"submit\" value=\"Edit\"></form></td></tr>";
            }
            echo "<tr><td height=\"10\"></td></tr>";
          }
        echo "</table>";
        if ($_SESSION['logged_in']){
          echo "<form action=\"guide.php?mode=add&type=cultural\" method=\"post\">\n";
          echo "<textarea rows=\"3\" cols=\"40\" name=\"cultural\"></textarea><input type=\"hidden\" value=\"".$_GET['ep']."\" name=\"ep\"><br><input type=\"submit\" value=\"Submit\"></form>";
        }
        echo "</td></tr>";
        echo "</table>";
        echo "<table border = 0><tr><td><a href=\"guides/$last_ep\"><img border=\"0\" src=\"images/previous.jpg\" alt=\"Prevoius Episode\"></a></td><td width=\"60%\"></td><td><a href=\"guides/$next_ep\"><img border=\"0\" src=\"images/next.jpg\" alt=\"Next Episode\"></a></td></tr></table>";
      }

    // "ep" variable is used and valus is "movie" and "id" variable is used
     elseif ($_GET['ep'] == "movie" && isset($_GET['id']))
      {
        // Request movie/video information
        $movie = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_dvdmovie WHERE Id = '".$_GET['id']."'"));
        $movie1 = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_dvdguide WHERE DVD_ID = '".$_GET['id']."'"));
        // Is it Individual Episodes or a dvd/video or a TV movie?
        if ($movie1['Type'] == "Individual")
          {
            // Individual Episodes on DVD/video
            $type = "Individual Episodes";
          }
         else
          {
            // TV Movie or DVD/Video
            $type = $movie1['Type'];
          }
        // Begin Page Output
        // Display title
        echo "<h2>".$movie['Title']."</h2>";
        echo "<br><table align=\"center\" width=\"75%\" border=\"1\" rules=\"rows\">\n";
        echo "<tr><th>Basic Information:</th></tr>\n";
        echo "<tr><td><table width=\"100%\"><tr><td align=\"center\" valign=\"top\"><b>Format:</b> ".$movie['Format']."<br><br>\n";
        echo "<b>Type:</b> ".$type."<br><br>\n";
        echo "<b>Release/Air Date:</b> ".$movie['AirDate']."<br><br>\n";
        echo "<b>Production Number:</b> ".$movie['ProdId']."<br><br>\n";
        echo "</td><td align=\"center\" valign=\"top\"><b>Director:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($movie1['Director']);
        echo "<br><br>\n";
        // If the type is  NOT individual episodes
        if ($movie1['Type'] != "Individual")
          {
            echo "<b>Writer:</b> ";
            // Format names and output IMDB linkage
            crew_imdb($movie1['Writer']);
            echo "<br><br>\n";
          }
        echo "<b>Producer:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($movie1['Producer']);
        echo "<br><br>\n";
        echo "<b>Executive Producer:</b> ";
        // Format names and output IMDB linkage
        crew_imdb($movie1['Executive']);
        echo "<br><br>\n";
        echo "</td></tr>\n";
        // If the type IS individual episodes
        if ($movie1['Type'] == "Individual")
          {
            echo "<tr><td align=\"center\" colspan=\"2\"><b>Episodes:</b> ";
            // Similar to crew_imdb() function, only no IMDB linkage
            $titles = explode(", ", $movie1['Episodes']);
            $size = sizeof($titles);
            for ($i=0; $i<$size; $i++)
             {
               $ep = mysql_fetch_array(mysql_query("SELECT EpId FROM kpfw_eplist WHERE EpTitle = '".$titles[$i]."'"));
               echo "<a href=\"guides/".$ep['EpId']."\">".$titles[$i]."</a>&nbsp;&nbsp;";
             }
            echo "</td></tr>";
          }
        echo "</table></td></tr>\n";
        echo "<tr><th>Notes:</th></tr>";
        echo "<tr><td align=\"center\"><table align=\"center\" width=\"50%\">";
        // Request Notes from database
        $dvdnotes = mysql_query("SELECT DVDNoteID,NoteText,UserId FROM kpfw_dvdnotes WHERE DVD_ID = '".$_GET['id']."'");
        // Notes loop
        while($note = mysql_fetch_array($dvdnotes))
          {
            $usern = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$note['UserId']."'"));
            echo "<tr><td>".nl2br(bbcode($note['NoteText']))."<br>-<a href=\"profile/".$note['UserId']."\">".$usern['UserName']."</a></td></tr>";
            if ($_SESSION['userID'] == $note['UserId'] || $_SESSION['UserLevel'] == "3"){
              echo "<tr><td align=\"right\"><form action=\"guide.php?mode=edit\" method=\"post\">\n";
              echo "<input type=\"hidden\" name=\"type\" value=\"dvdnote\">";
              echo "<input type=\"hidden\" name=\"noteid\" value=\"".$dvdnotes['DVDNoteID']."\">\n";
              echo "<input type=\"submit\" value=\"Edit\"></form></td></tr>";
            }
            echo "<tr><td height=\"25\"></td></tr>";
          }
        echo "</table>";
        if ($_SESSION['logged_in']){
          echo "<form action=\"guide.php?mode=add&type=dvdnote\" method=\"post\">\n";
          echo "<textarea rows=\"3\" cols=\"40\" name=\"note\"></textarea><input type=\"hidden\" value=\"".$_GET['id']."\" name=\"dvd\"><br><input type=\"submit\" value=\"Submit\"></form>";
        }
        echo "</td></tr>";
        echo "</table><br><br>\n";
      }
  }
 // "mode" variable IS used and is "list", all additional variables ignored
 elseif ($_GET['mode'] == "list")
  {
    // Include header and set page title
    incheader("Guides");
    // Guides links/Begin page output
    echo "<a name=\"top\"></a>";
	include("includes/guides_table.inc");
	echo "<table width=\"75%\" align=\"center\"><tr><td colspan=\"4\"><h2><a name=\"s1\">Season 1</h2></td></tr>";
    echo "<tr><th>Episode<br>Number</th><th>Episode Title</th><th>Air Date</th><th>Production<br>Number</th></tr>";
    // Request season 1 from database
    $eplist1 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 1' ORDER BY EpId ASC");
    // Display and list season 1 information
    while($s1 = mysql_fetch_array($eplist1))
      {
        echo "<tr><td align=\"center\">".$s1['EpNumber']."</td><td align=\"center\"><a href=\"guides/".$s1['EpId']."\">".strip_gpc_slashes($s1['EpTitle'])."</a></td>";
        echo "<td align=\"center\">".$s1['AirDate']."</td><td align=\"center\">".$s1['ProdId']."</td></tr>";
      }
    echo "<tr><td colspan=\"4\" height=\"20\"></td></tr>";
    echo "<tr><td colspan=\"4\"><h2><a name=\"s2\">Season 2</a></h2></td></tr>";
    echo "<tr><th>Episode<br>Number</th><th>Episode Title</th><th>Air Date</th><th>Production<br>Number</th></tr>";
    // Request season 2 from database
    $eplist2 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 2' ORDER BY EpId ASC");
    // Display and list season 2 information
    while($s2 = mysql_fetch_array($eplist2))
      {
        echo "<tr><td align=\"center\">".$s2['EpNumber']."</td><td align=\"center\"><a href=\"guides/".$s2['EpId']."\">".strip_gpc_slashes($s2['EpTitle'])."</a></td>";
        echo "<td align=\"center\">".$s2['AirDate']."</td><td align=\"center\">".$s2['ProdId']."</td></tr>";
      }
    echo "<tr><td colspan=\"4\" height=\"20\"></td></tr>";
    echo "<tr><td colspan=\"4\"><h2><a name=\"s3\">Season 3</a></h2></td></tr>";
    echo "<tr><th>Episode<br>Number</th><th>Episode Title</th><th>Air Date</th><th>Production<br>Number</th></tr>";
    // Request season 3 from database
    $eplist3 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 3' ORDER BY EpId ASC");
    // Display and list season 3 information
    while($s3 = mysql_fetch_array($eplist3))
      {
        echo "<tr><td align=\"center\">".$s3['EpNumber']."</td><td align=\"center\"><a href=\"guides/".$s3['EpId']."\">".strip_gpc_slashes($s3['EpTitle'])."</a></td>";
        echo "<td align=\"center\">".$s3['AirDate']."</td><td align=\"center\">".$s3['ProdId']."</td></tr>";
      }
    echo "<tr><td colspan=\"4\" height=\"20\"></td></tr>";
    echo "<tr><td colspan=\"4\"><h2><a name=\"s4\">Season 4</a></h2></td></tr>";
    echo "<tr><th>Episode<br>Number</th><th>Episode Title</th><th>Air Date</th><th>Production<br>Number</th></tr>";
    // Request season 4 from database
    $eplist4 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 4' ORDER BY EpId ASC");
    // Display and list season 4 information
    while($s4 = mysql_fetch_array($eplist4))
      {
        echo "<tr><td align=\"center\">".$s4['EpNumber']."</td><td align=\"center\"><a href=\"guides/".$s4['EpId']."\">".strip_gpc_slashes($s4['EpTitle'])."</a></td>";
        echo "<td align=\"center\">".$s4['AirDate']."</td><td align=\"center\">".$s4['ProdId']."</td></tr>";
      }
    echo "<tr><td colspan=\"4\" height=\"20\"></td></tr>";
    echo "<tr><td colspan=\"4\"><h2><a name=\"dvd\">DVDs/Movies</a></h2></td></tr>";
    echo "<tr><th>Format</th><th>Episode Title</th><th>Release/Air<br>Date</th><th>Production<br>Number</th></tr>";
    // Requestion DVD/Movie information
    $eplistdvd = mysql_query("SELECT * FROM kpfw_dvdmovie ORDER BY Id ASC");
    // Display and list DVD/Movie information
    while($mlist = mysql_fetch_array($eplistdvd))
      {
        echo "<tr><td align=\"center\">".$mlist['Format']."</td><td align=\"center\"><a href=\"movie/".$mlist['Id']."\">".strip_gpc_slashes($mlist['Title'])."</a></td>";
        echo "<td align=\"center\">".$mlist['AirDate']."</td><td align=\"center\">".$mlist['ProdId']."</td></tr>";
      }
    echo "</table><br><br><br>";
  }
// Include footer and end page
footer();
?>
