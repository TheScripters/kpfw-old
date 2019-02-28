<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******functions.php************/

// Domain checking
if ("http://".$_SERVER['HTTP_HOST'] != "http://www.kpfanfiction.com")
  {
    $url = str_replace("fanfic/","",$_SERVER['REQUEST_URI']);
    header("HTTP/1.1 302 Moved Permanently");
    header("Location: http://www.kpfanfiction.com".$url);
  }

// Begin session variables
//session_start();
include "includes/session.php";

// Internal page navigation
$page = $_SERVER['REQUEST_URI'];

// Database connection
define('DB_READY',TRUE);
(!$db) ? include("includes/db.php") : include("includes/db".$db.".php");

// Banning System
include("includes/user_ban.php");
$IP_Ban = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS banned FROM kpfw_ip_bans WHERE Ban_IP = '".$_SERVER['REMOTE_ADDR']."'"));
if ($IP_Ban['banned'] == "1")
  {
    header("HTTP/1.0 403 Forbidden");
    echo "<html>\n<head>\n<title>Kim Possible Fan World .:::. Error</title>\n<base href=\"http://www.kpfanworld.com/\">\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n";
    echo "</head>\n\n<body><br><center><img src=\"images/kpfwlogo.jpg\"><br><br><font color=\"#FFFF00\" size=\"4\"><b>Your current IP (".$_SERVER['REMOTE_ADDR'].") has been banned.<br>If you feel this in error, please contact the management at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>.<br><br>Thank You.</center>\n</body>\n</html>";
    exit;
  }

// Time Zone Management
if (!isset($_SESSION['logged_in'])) {$_SESSION['TZone'] = "-14400";}

// Email headers
$_SESSION['headers'] = "Reply-to: staff@kpfanworld.com\nFrom: staff@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n";

function mail_user($uid,$active)
  {
    $userinfo = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$uid."'"));
    $Active = ($active == "1") ? "activated" : "deactivated";
    mail($userinfo['UserEmail'],"Account $Active on KP Fan World","Hello ".$userinfo['UserName'].",\n\nThis email is to inform you that your account has been $Active on KP Fan World.\n\nIf this is not right, you may email us at staff@kpfanworld.com\n\nThank you,\nKP Fan World Management","Reply-to: staff@kpfanworld.com\nFrom: staff@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
  }

// key generation function created by thebomb-hq@gmx.de
// code found at http://us3.php.net/rand
function randomkeys($length)
 {
  $pattern = "123456789aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPgQrRsStTuUvVwWxXyYzZ";
  for($i=0;$i<$length;$i++)
  {
    $key .= $pattern{rand(0,35)};
  }
  return $key;
 }

// Username/Email validation functions
function validuser($username)
  {
    if (ereg('^[a-zA-Z0-9][a-zA-Z0-9\_][^\'\#\"\!\$\%\^\&\:\;\/\?\>\<]+$',$username))
      return true;
    else
      return false;
  }

function valid_email($address)
 {
  if (ereg('^[a-zA-Z0-9][a-zA-Z0-9\_\.\-]+@[a-zA-Z0-9\-]+.[a-zA-Z0-9\-\.]+$', $address))
    return true;
  else
    return false;
 }

// META Tag Description/Keywords function
function meta_tags()
  {
     $keywords_sql = mysql_query("SELECT Config_Value FROM kpfw_config WHERE Config_ID = 'Keywords'");
     $keywords = mysql_fetch_array($keywords_sql);
     echo "<meta name=\"keywords\" content=\"".strip_gpc_slashes($keywords['Config_Value'])."\">\n";
     $descrip_sql = mysql_query("SELECT Config_Value FROM kpfw_config WHERE Config_ID = 'Description'");
     $descrip = mysql_fetch_array($descrip_sql);
     echo "<meta name=\"description\" content=\"".strip_gpc_slashes($descrip['Config_Value'])."\">\n";
  }

// BBCode Function
function bbcode($text)
  {
    $bbcode = array(
                'bold' => '/\[b\](.*?)\[\/b\]/ims',
                'italic' => '/\[i\](.*?)\[\/i\]/ims',
                'underline' => '/\[u\](.*?)\[\/u\]/ims',
                'strike' => '/\[strike\](.*?)\[\/strike\]/ims',
                'spoiler' => '/\[spoiler\](.*?)\[\/spoiler\]/ims',
                'url' => '/\[url\](.*?)\[\/url\]/',
                'url1' => '/\[url=(.*?)\](.*?)\[\/url\]/',
                'quote' => '/\[quote\](.*?)\[\/quote\]/ims',
                'image' => '/\[img\](http:\/\/.*?)\[\/img\]/',
                'email' => '/\[email\](.*?)\[\/email\]/',
                'font' => '/\[font=(.*?)\](.*?)\[\/font\]/ims',
                'align' => '/\[align=(center|right|left|justify)\](.*?)\[\/align\]/ims',
                'center' => '/\[center\](.*?)\[\/center\]/ims'
);

    $replace = array(
                'bold' => '<b>\\1</b>',
                'italic' => '<i>\\1</i>',
                'underline' => '<u>\\1</u>',
                'strike' => '<strike>\\1</strike>',
                'spoiler' => '<span class="spoiler" onmouseover="this.style.color=\'white\';return true" onmouseout="this.style.color=\'black\';return true">\\1</span>',
                'url' => '<a href="\\1" target="_blank">\\1</a>',
                'url1' => '<a href="\\1" target="_blank">\\2</a>',
                'quote' => '<blockquote><h3 class="quote">Quote:</h3><hr align="left" width="65%">\\1</blockquote><br />',
                'image' => '<img src="\\1" border="0" alt="">',
                'email' => '<a href="mailto:\\1">\\1</a>',
                'font' => '<font face="\\1">\\2</font>',
                'align' => '<span style="text-align:\\1">\\2</span>',
                'center' => '<center>\\1</center>'
);
    $text = preg_replace("/<(.*?)>/", "&lt;\\1&gt;", $text);
    $text = preg_replace($bbcode, $replace, $text);
    return $text;
  }
  
// Word Censor
function censor($text)
  {
    $censor = mysql_fetch_array(mysql_query("SELECT Config_Value AS words FROM kpfw_config WHERE Config_ID = 'word_censor'"));
    $words = explode(", ",$censor['words']);
    $size = sizeof($words);
    for($i=0;$i<$size;$i++)
      {
        $length = strlen($words[$i]);
        $r = "*";
        for($j=1;$j<=$length;$j++)
          {
            if (isset($replace)){
              $replace .= $r;
            } else {
              $replace = $r;
            }
          }
        $text = str_replace($words[$i],$replace,$text);
        $replace = NULL;
      }
    return $text;
  }

// Show new private message count
function privmsg($uid)
  {
    $PMCountNew = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS PMNew FROM kpfw_privmsg WHERE To_User = '$uid' AND New = '1'"));
    $PMCountTotal = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS PMTotal FROM kpfw_privmsg WHERE To_User = '$uid'"));
    echo "<b>".$PMCountNew['PMNew']."</b> new messages of <a href=\"privmsg.php\">".$PMCountTotal['PMTotal']."</a>";
  }

// strip_gpc_slashes function created by ferik100@flexis.com.br
// code found at http://www.php.net/stripslashes
function strip_gpc_slashes ($input)
 {
  if ( !get_magic_quotes_gpc() || ( !is_string($input) && !is_array($input) ) )
   {
    return $input;
   }
  if ( is_string($input) )
   {
    $output = stripslashes($input);
   }
  elseif ( is_array($input) )
   {
    $output = array();
    foreach ($input as $key => $val)
     {
      $new_key = stripslashes($key);
      $new_val = strip_gpc_slashes($val);
      $output[$new_key] = $new_val;
     }
   }
  return $output;
 }

// Registration form function
function registration_form()
 {
   echo "<center><form action=\"register.php\" method=\"post\">
Required fields marked with *
<table>
  <tr>
    <td align=\"right\"><b>*Username:</b></td>
    <td><input type=\"text\" name=\"UserName\" value=\"$UserName\" maxlength=\"40\"></td>
  </tr>
  <tr>
    <td align=\"right\"><b>*Email Address:</b></td>
    <td><input type=\"text\" name=\"Email\" value=\"$UEmail\"></td>
  </tr>
  <tr>
    <td align=\"right\"><b>*Password:</b></td>
    <td><input type=\"password\" name=\"Password\"></td>
  </tr>
  <tr>
    <td align=\"right\"><b>*Password:</b></td>
    <td><input type=\"password\" name=\"pwd_conf\"></td>
  </tr>
  <tr>
    <td colspan=\"2\" align=\"center\"><b>Visual Confirmation:</b><br><img src=\"includes/visual_conf.php?".SID."\"><br><h6 style=\"font-size:10pt;font-weight:normal;margin:6px\">Code is case-sensitive.</h6><input type=\"text\" name=\"code_confirm\"></td>
  </tr>
  <tr>
    <td align=\"right\"><b>Name:</b></td>
    <td><input type=\"text\" name=\"Name\" value=\"$Name\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"2\"><b>Show Email:</b> <input type=\"checkbox\" name=\"ShowEmail\" value=\"True\"><br><input type=\"hidden\" name=\"mode\" value=\"submit\"><input type=\"submit\" value=\"Register\"></td>
  </tr>
</table>
</form></center>";
   }

// Header/footer functions
function incheader($page)
  {
    $pagename = $page;
    include("includes/header.inc");
  }

function footer()
  {
    include("includes/footer.inc");
    exit;
  }
?>
