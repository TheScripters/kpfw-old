<?php
session_start();
function html_header()
  {
    echo "<html>\n<head>\n<title>Episode List Data Population</title>\n</head>\n\n<body>\n";
  }
function html_footer()
  {
    echo "\n</body>\n<html>";
  }
function submit_form($season)
  {
    echo "<form action=\"eplist.php?p=submit\" method=\"post\">";
    echo "\n\t\t<tr>\n\t\t<td><input type=\"text\" name=\"EpNumber\" size=\"3\" maxlength=\"3\"></td>\n\t\t<td><input type=\"text\" maxlength=\"35\" name=\"EpTitle\"></td>\n\t\t<td><input type=\"text\" name=\"AirDate\" maxlength=\"18\" value=\"May 01, 2006\"></td>\n\t\t<td><input type=\"text\" name=\"ProdId\" value=\"$season-1, ".$season."01\"></td>\n\t\t<td><input type=\"text\" maxlength=\"255\" name=\"EpDesc\"><input type=\"hidden\" name=\"season\" value=\"$season\"></td>\n\t\t</tr>";
    echo "\n\t<tr>\n\t\t<td colspan=\"5\" align=\"center\"><input type=\"submit\" value=\"Submit\"></form></td>\n\t</tr>";
  }
// Include database connection data
define('DB_READY',TRUE);
include("includes/db.php");
// Include remove slashes function script-thing
include("includes/slashes.php");
// If the variable "p" does not exist...
if (empty($_GET['p']))
  {// If the user is NOT logged in...
    if (empty($_SESSION['Logged_In']))
      {// Show login form...
        html_header();
        echo "<center><br><br>\n<h1>Login to update!</h1>\n";
        echo "<br><br>\n<form action=\"eplist.php?p=login\" method=\"post\">\n";
        echo "<input type=\"text\" name=\"UserName\" maxlength=\"15\"><br>\n";
        echo "<input type=\"password\" name=\"Password\" max;ength=\"15\"><br>\n";
        echo "<input type=\"submit\" value=\"Login!\"></form>";
        html_footer();
      }// If the user IS logged in....
    if ($_SESSION['Logged_In'] == "True")
      {// Display logout link
        html_header();
        echo "<br><br>\n<span style=\"text-align:right\"><a href=\"eplist.php?p=logout\">Logout</a> (".$_SESSION['uname'].")</span>\n";
        // Display heading at top
        echo "<br><br><br>\n\n\n<center>\n<h1>Episode List Update</h1>\n";
        // Start episode listing table
        echo "<br><br>\n<table width=\"80%\">\n\t\t<tr>\n\t\t<th>Episode Number</th>\n\t\t<th width=\"150\">Episode Title</th>\n\t\t<th width=\"150\">Air Date</th>\n\t\t<th width=\"150\">Production Number</th>\n\t\t<th>Episode Description</th>\n\t</tr>";
        //Start at episodes in Season 1
        echo "\n\t<tr>\n\t\t<td align=\"center\" colspan=\"5\"><font size=\"4\">Season 1</font></td>\n\t</tr>";
        // Query database for episodes in Season 1
        $s1 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 1' ORDER BY EpId ASC");
        // Begin loop for listing all episodes in Season 1
        while($season1 = mysql_fetch_array($s1))
          {
            echo "\n\t<tr>\n\t\t<td align=\"right\" valign=\"top\">";
            if ($_SESSION['level'] >= "2")
              {
                echo "<a href=\"eplist.php?p=edit&ep=".$season1['EpId']."\">".$season1['EpNumber']."</a></td>";
              }
            if ($_SESSION['level'] == "1")
              {
                echo $season1['EpNumber']."</td>";
              }
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season1['EpTitle']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season1['AirDate']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season1['ProdId']."</td>";
            echo "\n\t\t<td>".strip_gpc_slashes($season1['EpDesc'])."</td>\n\t</tr>";
          }
        if ($_SESSION['level'] >= "2")
          {
            // Display submission form for submitting to season 1 episodes
            submit_form(1);
          }
        // Begin Season 2
        echo "\n\t<tr>\n\t\t<td align=\"center\" colspan=\"5\"><font size=\"4\">Season 2</td>\n\t</tr>";
        // Query for S2
        $s2 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 2' ORDER BY EpId ASC");
        // Loop for S2
        while($season2 = mysql_fetch_array($s2))
          {
            echo "\n\t<tr>\n\t\t<td align=\"right\" valign=\"top\">";
            if ($_SESSION['level'] >= "2")
              {
                echo "<a href=\"eplist.php?p=edit&ep=".$season2['EpId']."\">".$season2['EpNumber']."</a></td>";
              }
            if ($_SESSION['level'] == "1")
              {
                echo $season2['EpNumber']."</td>";
              }
            echo "\n\t\t<td align=\"center\" valign=\"top\">".strip_gpc_slashes($season2['EpTitle'])."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season2['AirDate']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season2['ProdId']."</td>";
            echo "\n\t\t<td>".strip_gpc_slashes($season2['EpDesc'])."</td>\n\t\t</tr>";
          }//Display submission to S2
        if ($_SESSION['level'] >= "2")
          {
            submit_form(2);
          }
        // Begin S3
        echo "\n\t<tr>\n\t\t<td align=\"center\" colspan=\"5\"><font size=\"4\">Season 3</td>\n\t</tr>";
        // Query for S3
        $s3 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 3' ORDER BY EpId ASC");
        // Loop for S3
        while($season3 = mysql_fetch_array($s3))
          {
            echo "\n\t<tr>\n\t\t<td align=\"right\" valign=\"top\">";
            if ($_SESSION['level'] >= "2")
              {
                echo "<a href=\"eplist.php?p=edit&ep=".$season3['EpId']."\">".$season3['EpNumber']."</a></td>";
              }
            if ($_SESSION['level'] == "1")
              {
                echo $season3['EpNumber']."</td>";
              }
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season3['EpTitle']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season3['AirDate']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season3['ProdId']."</td>";
            echo "\n\t\t<td>".strip_gpc_slashes($season3['EpDesc'])."</td>\n\t\t</tr>";
          }// Display submission to S3
        if ($_SESSION['level'] >= "2")
          {
            submit_form(3);
          }
        // Begin S4
        echo "\n\t<tr>\n\t\t<td align=\"center\" colspan=\"5\"><font size=\"4\">Season 4</td>\n\t</tr>";
        // Query for S4
        $s4 = mysql_query("SELECT * FROM kpfw_eplist WHERE Season = 'Season 4' ORDER BY EpId ASC");
        // Loop for S4
        while($season4 = mysql_fetch_array($s4))
          {
            echo "\n\t<tr>\n\t\t<td align=\"right\" valign=\"top\">";
            if ($_SESSION['level'] >= "2")
              {
                echo "<a href=\"eplist.php?p=edit&ep=".$season4['EpId']."\">".$season4['EpNumber']."</a></td>";
              }
            if ($_SESSION['level'] == "1")
              {
                echo $season3['EpNumber']."</td>";
              }
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season4['EpTitle']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season4['AirDate']."</td>";
            echo "\n\t\t<td align=\"center\" valign=\"top\">".$season4['ProdId']."</td>";
            echo "\n\t\t<td>".strip_gpc_slashes($season4['EpDesc'])."</td>\n\t\t</tr>";
          }// Display submission to S4
        if ($_SESSION['level'] >= "2")
          {
            submit_form(4);
          }
        // End page
        echo "\n</table>";
        html_footer();
      }
  }// If the "p" variable says it's to login...
if ($_GET['p'] == "login")
  {
    // Request submitted username
    $UName = $_REQUEST['UserName'];
    //Request and encrypt submitted password
    $Pass = md5($_REQUEST['Password']);
    // See if user exists and request stored encrypted password
    $login = mysql_query("SELECT UserId,Password,UserLevel FROM kpfw_users WHERE UserName = '$UName'");
    // Request values for use in script
    $login1 = mysql_fetch_array($login);
    // If submitted password encryption matches encryption of stored password...
    if ($Pass == $login1['Password'])
      {
        // Set Session variable to allow user to view page
        $_SESSION['Logged_In'] = "True";
        $_SESSION['uid'] = $login1['UserId'];
        $_SESSION['uname'] = $UName;
        $_SESSION['level'] = $login1['UserLevel'];
        // Redirect to main page
        header("Location: eplist.php");
      }
     else
      {
        html_header();
        // Password or username was incorrect, redisplay login form to give another chance
        echo "<center><br><br><h1>Login to update!</h1><br>\n<h2>Username or password incorrect!</h2>";
        echo "<br><br>\n\n<form action=\"eplist.php?p=login\" method=\"post\">";
        echo "\n<input type=\"text\" name=\"UserName\" maxlength=\"15\"><br>";
        echo "\n<input type=\"password\" name=\"Password\" max;ength=\"15\"><br>";
        echo "\n<input type=\"submit\" value=\"Login!\"></form>";
        html_footer();
      }
  }// User wants to logout...
if ($_GET['p'] == "logout")
  {
    // Clear all session variables
    unset($_SESSION);
    session_destroy();
    // Redirect to main page
    header("Location: eplist.php");
  }// User is submitting an episode...
if ($_GET['p'] == "submit")
  {
    //Request all submitted information
    $EpTitle = $_REQUEST['EpTitle'];
    $EpNumber = $_REQUEST['EpNumber'];
    $AirDate = $_REQUEST['AirDate'];
    $ProdId = $_REQUEST['ProdId'];
    $Season = $_REQUEST['season'];
    $EpDesc = $_REQUEST['EpDesc'];
    // Insert submitted info into database
    $sql = mysql_query("INSERT INTO kpfw_eplist VALUES (NULL, '$EpNumber','$AirDate','$EpTitle', '$EpDesc', '$ProdId', 'Season $Season', '')");
    // Redirect to main page
    header("Location: eplist.php");
  }// User wants to edit a listing...
if ($_GET['p'] == "edit")
  {
    if ($_SESSION['level'] >= "2")
      {
    // See which episode the user wants to edit...
    $EpId = $_REQUEST['ep'];
    // Query for information
    $EditEp = mysql_query("SELECT * FROM kpfw_eplist WHERE EpId = '$EpId'");
    $EpGuide = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_epguide WHERE EpId = '$EpId'"));
    $Transcript = mysql_fetch_array(mysql_query("SELECT ScriptText AS Text FROM kpfw_transcript WHERE EpId = '$EpId'"));
    // Request values for usage in script
    $Edit = mysql_fetch_array($EditEp);
    // Display submission form with current values within it
    html_header();
    echo "<br><br><center><form action=\"eplist.php?p=editep\" method=\"post\">\n";
    echo "<b>Ep Number:</b> <input type=\"text\" name=\"EpNumber\" value=\"".$Edit['EpNumber']."\">&nbsp;&nbsp;<b>Episode Title:</b> <input type=\"text\" name=\"EpTitle\" value=\"".stripslashes($Edit['EpTitle'])."\"><br>\n";
    echo "<b>Air Date:</b> <input type=\"text\" name=\"AirDate\" value=\"".$Edit['AirDate']."\">&nbsp;&nbsp;<b>Production Number:</b> <input type=\"text\" name=\"ProdId\" value=\"".$Edit['ProdId']."\"><br>\n";
    echo "<b>Season:</b> <input type=\"text\" name=\"season\" value=\"".$Edit['Season']."\"><br>\n";
    echo "<b>Studio:</b> <input type=\"text\" name=\"Studio\" value=\"".$EpGuide['Studio']."\"><br>\n";
    echo "<b>Writer:</b> <input type=\"text\" name=\"writer\" value=\"".$EpGuide['Writer']."\"><br>\n";
    echo "<b>Director:</b> <input type=\"text\" name=\"Director\" value=\"".$EpGuide['Director']."\"><br>\n";
    echo "<b>Producer:</b> <input type=\"text\" name=\"Producer\" value=\"".$EpGuide['Producer']."\"><br>\n";
    echo "<b>Executive Producer:</b> <input type=\"text\" name=\"Executive\" value=\"".$EpGuide['Executive']."\"><br>\n";
    echo "<b>Episode Description:</b><br><textarea rows=\"3\" cols=\"30\" name=\"EpDesc\">".strip_gpc_slashes($Edit['EpDesc'])."</textarea><br>\n";
    echo "<b>Episode Recap:</b><br><textarea cols=\"50\" rows=\"8\" name=\"recap\">".strip_gpc_slashes($EpGuide['EpRecap'])."</textarea><br>\n";
    echo "<b>Transcript:</b><br><textarea cols=\"60\" rows=\"15\" name=\"Script\">".strip_gpc_slashes($Transcript['Text'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"EpId\" value=\"$EpId\"><input type=\"submit\" value=\"Submit\"></form></center>";
    html_footer();
      }
  }// User submitted the changes...
if ($_GET['p'] == "editep")
  {
    // Request submitted information
    $EpNumber = $_REQUEST['EpNumber'];
    $AirDate = $_REQUEST['AirDate'];
    $EpTitle = addslashes($_REQUEST['EpTitle']);
    $EpDesc = addslashes($_REQUEST['EpDesc']);
    $ProdId = $_REQUEST['ProdId'];
    $Season = $_REQUEST['season'];
    $Studio = $_REQUEST['Studio'];
    $Writer = $_REQUEST['writer'];
    $Director = $_REQUEST['Director'];
    $Producer = $_REQUEST['Producer'];
    $Executive = $_REQUEST['Executive'];
    $Transcript = addslashes($_REQUEST['Script']);
    $Recap = addslashes($_REQUEST['recap']);
    $EpId = $_REQUEST['EpId'];
    // Update information for this episode
    $sql = mysql_query("UPDATE kpfw_eplist SET EpNumber = '$EpNumber',AirDate = '$AirDate', EpTitle = '$EpTitle', EpDesc = '$EpDesc', ProdId = '$ProdId', Season = '$Season' WHERE EpId = '$EpId'");
    $sql = mysql_query("UPDATE kpfw_epguide SET Studio = '$Studio',Writer = '$Writer',Director = '$Director',Producer = '$Producer',Executive = '$Executive',EpRecap = '$Recap' WHERE EpId = '$EpId'");
    $sql = mysql_query("UPDATE kpfw_transcript SET ScriptText = '$Transcript' WHERE EpId = '$EpId'");
    // Redirect to main page so user can see changes
    header("Location: eplist.php");
  }
?>
