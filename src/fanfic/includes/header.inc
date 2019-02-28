<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<?meta_tags();?>
<base href="http://www.kpfanfiction.com/">
<title>Kim Possible Fan World | FanFiction .:::. <?echo$pagename?></title>
<link title="RSS" rel="alternate" type="application/rss+xml" href="http://www.kpfanfiction.com/rss.php">
<link rel="stylesheet" type="text/css" href="includes/kpfw.css">
</head>

<body>
<table width="100%"><tr><td width="50%">&nbsp;</td><td width="50%" align="right">
<?php
if (!isset($_SESSION['logged_in']))
  {
    echo "<a href=\"register.php\">Register</a> || <a href=\"login.php\">Login</a><br>";
  }
if ($_SESSION['logged_in'] == "True")
  {
    echo "Hi, ".$_SESSION['UserName']."! <a href=\"login.php?mode=logout\">Logout</a> || <a href=\"profile.php?user=".$_SESSION['userID']."\">View</a>/<a href=\"profile.php\">Edit Profile</a><br>";
    echo "<a href=\"add\">Add Story/Chapter</a><br>";
    echo "<font size=\"-1\"><b>Your current IP:</b> <i>".$_SERVER['REMOTE_ADDR']."</i></font><br>";
  }
echo gmdate("M d, Y",time()+$_SESSION['TZone']);
?>
</td></tr></table>
<center><a href=""><img src="images/kpfwfflogo.jpg" alt="KP Fan World -- FanFiction" border="0"></a>
<h1><?echo$pagename?></h1>
<table>
  <tr>
    <td><a href="fic/list"><img src="images/stories.png" alt="Story Listing" border="0"></a>
    &nbsp;&nbsp;&nbsp;<a href="add"><img src="images/addstory.png" alt="Add Story" border="0"></a></td>
  </tr>
</table>
