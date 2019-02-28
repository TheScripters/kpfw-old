<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<?meta_tags();?>
<META name="verify-v1" content="OelR3u2bgO04EqsDfEv32oGfcb+hTDyXJVXmPkH+RCc=">
<base href="http://www.kpfanworld.com/">
<title>Kim Possible Fan World .:::. <?echo$pagename?></title>
<link rel="stylesheet" type="text/css" href="includes/kpfw.css">
</head>

<body>
<table width="100%"><tr><td width="50%">&nbsp;</td><td width="50%" align="right">
<?php
if (!isset($_SESSION['logged_in']))
  {
    echo "<a href=\"register.php\">Register</a> || <a href=\"login.php\">Login</a><br>\n";
    echo "<form action=\"login.php?mode=login\" method=\"post\" style=\"margin:1px\">\n";
    echo "<input type=\"hidden\" name=\"redirect\" value=\"".$_SERVER['REQUEST_URI']."\">\n";
    echo "<input type=\"text\" name=\"uname\" onclick=\"this.value='';\" value=\"username\" size=\"9\">&nbsp;&nbsp;<input type=\"password\" name=\"pwd\" onclick=\"this.value='';\" size=\"9\"><br>\n<input type=\"submit\" value=\"Login\">";
    echo "</form>";
  }
if ($_SESSION['logged_in'] == "True")
  {
    echo "Hi, ".$_SESSION['UserName']."! <a href=\"login.php?mode=logout\">Logout</a> || <a href=\"profile.php?user=".$_SESSION['userID']."\">View</a>/<a href=\"profile.php\">Edit Profile</a><br>";
    echo "<font size=\"-1\"><b>Your current IP:</b> <i>".$_SERVER['REMOTE_ADDR']."</i></font><br>";
    privmsg($_SESSION['userID']);
    echo "<br>";//<a href=\"memberlist.php\">Member List</a>";
    if ($_SESSION['UserLevel'] == "3")
      {
        echo "<a href=\"admin.php\">Admin Panel</a>";
      }
    if ($_SESSION['UserLevel'] >= "3")
      {
        echo " || <a href=\"http://dev.kpfanworld.com\">Developers</a><br>";
      }
  }
echo gmdate("M d, Y",time()+$_SESSION['TZone']);
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="margin-top:5px">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="paypal@kpfanworld.com">
<input type="hidden" name="item_name" value="Kim Possible Fan World">
<input type="hidden" name="item_number" value="kpfwms">
<input type="hidden" name="page_style" value="KPFW">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="bn" value="PP-DonationsBF">
<input type="submit" value="Donate" name="submit"><br><!-- Begin Official PayPal Seal --><a href="https://www.paypal.com/us/verified/pal=paypal%40kpfanworld%2ecom" target="_blank"><FONT size="2" face="verdana, arial, helvetica"><B>PayPal Verified</B></FONT></A><!-- End Official PayPal Seal -->
<!--<input type="image" src="http://www.kpfanworld.com/images/kpfw-donate.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">-->
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</td></tr></table>
<center><a href="http://www.kpfanworld.com"><img src="images/kpfwlogo.jpg" title="Kim Possible Fan World Home" alt="KP Fan World Home" border="0"></a>
<h1><?echo$pagename?></h1>
<table align="center" border="1" rules="none" width="820">
  <tr>
    <td align="center"><a href="links.php"><img src="images/links.jpg" border="0" alt="Links"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="eplist"><img src="images/guides.jpg" alt="Guides" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="media"><img src="images/media.jpg" border="0" alt="Media"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="about"><img src="images/about.jpg" border="0" alt="About"></a><br><a href="http://www.kpfanfiction.com" target="_blank"><img src="images/fanfic.jpg" border="0" alt="FanFiction"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="chat.php"><img src="images/chat.jpg" border="0" alt="Chat"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="downloads"><img src="images/downloads.jpg" border="0" alt="Downloads"></a></td>
  </tr>
</table>
<font size="+1"><a href="panel">Gargoyles Convention Material</a> || <a href="http://ronstoppable.proboards89.com" target="_blank">Message Board</a><?($_SESSION['logged_in']) ? print " || <a href=\"avhosting\">Avatar Hosting</a>" : "";?> || <a href="sitemap">Sitemap</a> || <a href="donate">Donations</a></font><br>
