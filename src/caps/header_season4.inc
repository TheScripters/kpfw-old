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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?print "<title>$episode_page_name</title>
<meta name=\"description\" content=\"$episode_page_name\">";?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="COPYRIGHT" content="Copyright Brian Wallace, All rights Reserved.">
<meta name="Coded" content="Coded in php by Brian Wallace.">
</head>
<body link="#FFFF00" vlink="#FF0000" alink="#FF0000" text="#00FF00" bgcolor="#000000">