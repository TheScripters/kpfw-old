<html>
<head>
<?meta_tags();?>
<base href="http://www.kpfanworld.com/">
<title>Kim Possible Fan World .:::. <?echo$pagename?></title>
<link rel="stylesheet" type="text/css" href="includes/kpfw.css">
</head>

<body text="#FFFFFF">
<table width="100%"><tr><td width="50%">&nbsp;</td><td width="50%" align="right">
<?php
if (!isset($_SESSION['logged_in']))
  {
    echo "<a href=\"register.php\">Register</a> || <a href=\"login.php\">Login</a>";
  }
if ($_SESSION['logged_in'] == "True")
  {
    echo "Hi, ".$_SESSION['UserName']."! <a href=\"login.php?mode=logout\">Logout</a> || <a href=\"profile.php\">View/Edit Profile</a><br>";
    echo "<font size=\"-1\"><b>Your current IP:</b> <i>".$_SERVER['REMOTE_ADDR']."</i></font><br>";
    privmsg($_SESSION['userID']);
    echo "<br>";
    if ($_SESSION['UserLevel'] == "3")
      {
        echo " <a href=\"admin.php\">Admin Panel</a>";
      }
    if ($_SESSION['UserLevel'] >= "3")
      {
        echo " || <a href=\"http://dev.kpfanworld.com\">Developers</a>";
      }
  }
echo "<br>".gmdate("M d, Y",time()+$_SESSION['TZone']);
?>
</td></tr></table>
<center><a href="http://www.kpfanworld.com"><img src="/images/kpfwlogo.jpg" title="Kim Possible Fan World Home" border="0"></a><br>
<h1><?echo$pagename?></h1>
<br>
