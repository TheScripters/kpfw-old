<?php
// Domain checking
if ($_SERVER['HTTP_HOST'] == "box200.bluehost.com")
  {
    $uri = str_replace("/~kpfanwor/caps/","",$_SERVER['REQUEST_URI']);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://caps.kpfanworld.com/".$uri);
  } elseif ($_SERVER['HTTP_HOST'] == "caps.kpfanworld.com" && substr($_SERVER['REQUEST_URI'],0,15) == "/~kpfanwor/caps") {
    $uri = str_replace("/~kpfanwor/caps/","",$_SERVER['REQUEST_URI']);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://caps.kpfanworld.com/".$uri);
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
<?print "<title>$episode_page_name</title>
<meta name=\"description\" content=\"$episode_page_name\" />";?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="COPYRIGHT" content="Copyright Brian Wallace, All rights Reserved." />
<meta name="Coded" content="Coded in php by Brian Wallace." />
<meta name="keywords" content="Kim Possible, KP, Ron Stoppable, Rufus, Drakken, Shego, Dementor, spoilers, season 4, screen caps, screen captures, kim possible images, KP images, kp screen caps, caps, images" />
</head>
<body link="#FFFF00" vlink="#FF0000" alink="#FF0000" text="#00FF00" bgcolor="#000000">