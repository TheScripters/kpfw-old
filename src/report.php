<?
if (!$_GET['mode']){
  define("DB_READY",TRUE);
  include("includes/db.php");
  $link = mysql_fetch_array(mysql_query("SELECT LinkTitle FROM kpfw_links WHERE LinkID = '".$_GET['link']."'"));
?><html>
<head>
<title>Report Broken Link</title>
<link rel="stylesheet" type="text/css" href="includes/kpfw.css">
</head>
<body>
<h1>Report Broken Link</h1>
<center><form action="report.php?mode=submit" method="post">
Reporting <b><?=$link['LinkTitle']?></b><br>
<b>Name:</b> <input type="text" name="name">&nbsp;&nbsp;&nbsp;<b>Email Address:</b> <input type="text" name="email"><br><br>
<input type="hidden" name="linkid" value="<?=$_GET['link']?>">
<img src="includes/visual_conf.php"><br>
<input type="text" name="visualconf"><br>
<input type="submit" value="Send Feedback">&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.close()" value="Cancel"></form></center>
</body>
</html>
<?
exit;
} elseif ($_GET['mode'] == "submit"){
  include("includes/functions.php");
  if (empty($_REQUEST['name']) || empty($_REQUEST['email']) || empty($_REQUEST['visualconf']))
    {
      echo "<html>\n<head>\n<title>Report Broken Link</title>\n<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n</head>\n<body>\n<h1>Report Broken Link</h1>\n<script type=\"text/javascript\" src=\"includes/rclick.js\"></script>\n";
      echo "<center><br>All fields are required!<br><br><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back\">\n";
      echo "<br></center>\n</body>\n</html>";
    }
   else
    {
      $name = $_REQUEST['name'];
      $email = $_REQUEST['email'];
      $linkid = $_REQUEST['linkid'];
      $visual = md5($_REQUEST['visualconf']);
      if (valid_email($email))
        {
          if ($visual == $_SESSION['visual_confirmation'])
            {
              $link = mysql_fetch_array(mysql_query("SELECT LinkTitle FROM kpfw_links WHERE LinkID = '$linkid'"));
              mail("staff@kpfanworld.com","Broken Link Reported on KP Fan World",strip_gpc_slashes("Dear Staff,\n\n$name ($email) has the following broken link:\n\n".$link['LinkTitle']."\n\n--------\nThank you.\n\nIP: ".$_SERVER['REMOTE_ADDR'].""),$headers);
              mail($email,"Link Reported as Broken on KP Fan World",strip_gpc_slashes("Dear $name,\n\nThe following link has been reported to the staff of KP Fan World:\n\n".$link['LinkTitle']."\n-------\nThank you.\n\nIP: ".$_SERVER['REMOTE_ADDR'].""),$headers);
              echo "<html>\n<head>\n<title>Report Broken Link</title>\n<link href=\"includes/kpfw.css\" type=\"text/css\" rel=\"stylesheet\">\n</head>\n<body><h1>Report Broken Link</h1>\n<script src=\"includes/rclick.js\" type=\"text/javascript\"></script>\n<br>\n";
              echo "<center>Link reported successfully!<br><br><input type=\"button\" onclick=\"window.close()\" value=\"Close Window\">\n";
              echo "<br></center>\n</body>\n</html>";
            }
           else
            {
              echo "<html>\n<head>\n<title>Report Broken Link</title>\n<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n</head>\n<body>\n<h1>Report Broken Link</h1>\n<script type=\"text/javascript\" src=\"includes/rclick.js\"></script>\n";
              echo "<center><br>Code incorrect! Please try again.<br><br><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back\">\n<br><br>If you continue to have problems, you may email us at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>\n";
              echo "<br></center>\n</body>\n</html>";
            }
        }
       else
        {
          echo "<html>\n<head>\n<title>Report Borken Link</title>\n<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n</head>\n<body>\n<h1>Report Broken Link</h1>\n<script type=\"text/javascript\" src=\"includes/rclick.js\"></script>\n";
          echo "<center><br>Email invalid! Please try again.<br><br><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back\">\n<br><br>If you continue to have problems, you may email us at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>\n";
          echo "<br></center>\n</body>\n</html>";
        }
    }
}
?>