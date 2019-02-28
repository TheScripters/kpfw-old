<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******functions.php************/

// Domain checking
if ($_SERVER['HTTP_HOST'] == "box200.bluehost.com")
  {
    $uri = str_replace("/~kpfanwor/","",$_SERVER['REQUEST_URI']);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://www.kpfanworld.com/".$uri);
  } elseif ($_SERVER['HTTP_HOST'] == "www.kpfanworld.com" && substr($_SERVER['REQUEST_URI'],0,10) == "/~kpfanwor") {
    $uri = str_replace("/~kpfanwor/","",$_SERVER['REQUEST_URI']);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://www.kpfanworld.com/".$uri);
  }


// Begin session variables
ini_set("session.name","kpfw");
session_start();

// Internal page navigation
$page = $_SERVER['REQUEST_URI'];

// Database connection
define('DB_READY',TRUE);
(!$db) ? include("includes/db.php") : include("includes/db".$db.".php");

// Activation reminder
include("includes/activatesend.php");

// Membership Update Notices
include("includes/memberupdate.php");

// Banning System
include("includes/user_ban.php");
$IP_Ban = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS banned FROM kpfw_ip_bans WHERE Ban_IP = '".$_SERVER['REMOTE_ADDR']."'"));
if ($IP_Ban['banned'] == "1")
  {
    header("HTTP/1.1 403 Forbidden");
    echo "<html>\n<head>\n<title>Kim Possible Fan World .:::. Error</title>\n<base href=\"http://www.kpfanworld.com/\">\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n";
    echo "</head>\n\n<body><br><center><img src=\"images/kpfwlogo.jpg\"><br><br><font color=\"#FFFF00\" size=\"4\"><b>Your current IP (".$_SERVER['REMOTE_ADDR'].") has been banned.<br>If you feel this in error, please contact the management at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>.<br><br>Thank You.</center>\n</body>\n</html>";
    exit;
  }

// Time Zone Management
if (!isset($_SESSION['logged_in'])) {$_SESSION['TZone'] = "-18000";}

// Email headers
$_SESSION['headers'] = "Reply-to: staff@kpfanworld.com\nFrom: webmaster@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n";

function mail_user($uid,$active)
  {
    $userinfo = mysql_fetch_array(mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserId = '".$uid."'"));
    $Active = ($active == "1") ? "activated" : "deactivated";
    mail($userinfo['UserEmail'],"Account $Active on KP Fan World","Hello ".$userinfo['UserName'].",\n\nThis email is to inform you that your account has been $Active on KP Fan World.\n\nIf this is not right, you may email us at staff@kpfanworld.com\n\nThank you,\nKP Fan World Management","Reply-to: staff@kpfanworld.com\nFrom: webmaster@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
  }
  
function mail_admin($section,$old,$new)
  {
    $adminsql = mysql_query("SELECT UserName,UserEmail FROM kpfw_users WHERE UserLevel = '3' AND UserEmail != 'webmaster@kpfanworld.com'");
        if ($old != ""){
          mail("staff@kpfanworld.com",$section." Changed on KP Fan World",stripslashes("Dear Staff Member,\n\nUser ".$_SESSION['UserName']." has updated information in the ".$section." section of KP Fan World.\n\nOriginal entry:\n\n".$old."\n\n---\n\nNew Entry:\n\n".$new."\n\n--\nThank you,\nKP Fan World Staff\nstaff@kpfanworld.com"),"Reply-to: staff@kpfanworld.com\nFrom: webmaster@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
        }
        else{
          mail("staff@kpfanworld.com",$section." Added to KP Fan World",stripslashes("Dear Satff Member,\n\nUser ".$_SESSION['UserName']." has added information in the ".$section." section of KP Fan World.\n\nNew Entry:\n\n".$new."\n\n--\nThank you,\nKP Fan World Staff\nstaff@kpfanworld.com"),"Reply-to: staff@kpfanworld.com\nFrom: webmaster@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
        }
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

function countdown($hour,$minute,$second,$month,$day,$year,$sens,$left,$exp,$len,$expire)
  {
    /***** Countdown function v 1.2 ***************
     ***** Written by Adam Humpherys **************
     ***** © 2006 Adam Humpherys ******************
     ***** http://www.adamh.us/projects/personal **
     ***** Usage:
     countdown([int hour,[int minute, [int second, [int month, [int day, [int year, [str sens, [str left, [str exp, [int len, [str exp]]]]]]]]]]]) **********/
    if (!$month || !$day || !$year || !$sens || !$left || !$exp || !$len || !$expire){
      $month = (!$month) ? 1 : "";
      $day = (!$day) ? 1 : "";
      $year = (!$year) ? 2007 : "";
      $sens = (!$sens) ? "sec" : "";
      $left = (!$left) ? "Estimated: %time%" : "%time%";
      $exp = (!$exp) ? "It's here!" : "";
      $len = (!$len) ? -86400 : "";
      $expire = (!$expire) ? "<b>Time Expired!</b>" : "";
    }
    $now = time();
    $date = mktime($hour,$minute,$second,$month,$day,$year);
    $secleft = $date-$now;
    if ($secleft >= 1){
      $dayleft = floor($secleft/86400);
      if ($sens == "hr" || $sens == "min" || $sens == "sec"){
        $dayhr = $secleft-($dayleft*86400);
        $hrleft = floor($dayhr/3600);
      }
      if ($sens == "min" || $sens == "sec"){
        $hrmin = $secleft-(($dayleft*86400)+($hrleft*3600));
        $minleft = floor($hrmin/60);
      }
      if ($sens == "sec"){
        $secsleft = $secleft-(($dayleft*86400)+($hrleft*3600)+($minleft*60));
      }
      if ($dayleft >= 2){
        $day = " days";
      } elseif ($dayleft == 1){
        $day = " day";
      }
      if ($hrleft >= 2){
        $hour = " hours";
      } elseif ($hrleft == 1){
        $hour = " hour";
      }
      if ($minleft >= 2){
        $minute = " minutes";
      } elseif ($minleft == 1){
        $minute = " minute";
      }
      if ($secsleft >= 2){
        $second = " seconds";
      } elseif ($secsleft == 1){
        $second = " second";
      }
      if ($dayleft >= 1 && ($hrleft >= 1 || $minleft >= 1 || $secsleft >= 1)){
        $timeleft = $dayleft.$day.", ";
      } elseif ($dayleft >= 1 && $hrleft == 0 && $minleft == 0 && $secsleft == 0){
        $timeleft = $dayleft.$day;
      }
      if ($hrleft >= 1 && ($minleft >= 1 || $secsleft >= 1)){
        $timeleft .= $hrleft.$hour.", ";
      } elseif ($hrleft >= 1 && $minleft == 0 && $secsleft == 0){
        $timeleft .= $hrleft.$hour;
      }
      if ($minleft >= 1 && $secsleft >= 1){
        $timeleft .= $minleft.$minute.", ";
      } elseif ($minleft >= 1 && $secsleft == 0){
        $timeleft .= $minleft.$minute;
      }
      if ($secsleft >= 1){
        $timeleft .= $secsleft.$second;
      }
      $time = $left;
      $timeleft = str_replace("%time%",$timeleft,$time);
    } elseif ($secleft <= 0 && $secleft >= $len){
      $timeleft = $exp;
    } elseif ($secleft <= 0 && $secleft < $len){
      $timeleft = $expire;
    }
    return $timeleft;
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

// IMDB Crew/cast URL creation
function crew_imdb($name)
 {
   $name1 = explode(", ", $name);
   $size = sizeof($name1);
   $j = 1;
   for($i=0;$i<$size;$i++)
    {
      $space = ($j<$size) ? "&nbsp;&nbsp;" : "";
      $imdb = preg_replace("/ /", "+", $name1[$i]);
      echo "<a href=\"http://www.imdb.com/Name?".$imdb."\" target=\"_blank\">".$name1[$i]."</a>".$space;
      $j++;
    }
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

// Episode Title changing function
function Ep_Trivia_Link($title)
  {
    if ($title=="A Sitch in Time: Present (1)"){
    	$link="asit_present";
    }else if ($title=="A Sitch in Time: Past (2)"){
      	$link="asit_past";
    }else if ($title=="A Sitch in Time: Future (3)"){
      	$link="asit_future";
    }else{
	    $link = stripslashes($title);
	    $link = preg_replace("/ /","_",$link);
	    $link = preg_replace("/\'/","",$link);
	    $link = preg_replace("/\./","",$link);
	    $link = strtolower($link);
	}
    return $link;
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
                'center' => '/\[center\](.*?)\[\/center\]/ims',
                'youtube' => '/\[youtube\]([A-Za-z0-9]*?)\[\/youtube\]/'
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
                'center' => '<center>\\1</center>',
                'youtube' => '<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/\\1"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/\\1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>'
);
    $text = preg_replace("/<(.*?)>/", "&lt;\\1&gt;", $text);
    $text = preg_replace($bbcode, $replace, $text);
    $text = stripslashes($text);
    return $text;
  }
  
//emoticon support 
function emoticon($text){
    $search = array(":P", "(:|", "=;", "/:)", ":))", ":)", ":((", ":(", ":oops:", "8O", ":?:", "8)", ":lol:", ":x", ":D", ":o", ":cry:", ":evil:", ":twisted:", ":roll:", ";;)", ";)", ":!:", ":?", ":idea:", ":arrow:", "=D>", "=P~", ":-B", "=))", ":-&", ":>", ":-O", ":-?", ":-S");
  	$replace = array(
	  "<img src=\"images/emoticons/10.gif\" border = \"0\" alt =\"[image]\">", 
	  "<img src=\"images/emoticons/35.gif\" border = \"0\" alt =\"(:|\">",
	  "<img src=\"images/emoticons/32.gif\" border = \"0\" alt =\"=;\">", 
	  "<img src=\"images/emoticons/28.gif\" border = \"0\" alt =\"[image]\">",
	  "<img src=\"images/emoticons/25.gif\" border = \"0\" alt =\"[image]\">",
	  "<img src=\"images/emoticons/2.gif\" border = \"0\" alt =\":)\">",
	  "<img src=\"images/emoticons/23.gif\" border = \"0\" alt =\"[image]\">",
	  "<img src=\"images/emoticons/3.gif\" border = \"0\" alt =\":(\">", 
	  "<img src=\"images/emoticons/11.gif\" border = \"0\" alt =\"[image]\">", 
	  "<img src=\"images/emoticons/5.gif\" border = \"0\" alt =\"8O\">", 
	  "<img src=\"images/emoticons/18.gif\" border = \"0\" alt =\"[image]\">",
	  "<img src=\"images/emoticons/7.gif\" border = \"0\" alt =\"8)\">", 
	  "<img src=\"images/emoticons/8.gif\" border = \"0\" alt =\":lol:\">", 
	  "<img src=\"images/emoticons/9.gif\" border = \"0\" alt =\":x\">", 
	  "<img src=\"images/emoticons/1.gif\" border = \"0\" alt =\":D\">", 
	  "<img src=\"images/emoticons/4.gif\" border = \"0\" alt =\":oops:\">", 
	  "<img src=\"images/emoticons/12.gif\" border = \"0\" alt =\":cry: \">", 
	  "<img src=\"images/emoticons/13.gif\" border = \"0\" alt =\":evil:\">", 
	  "<img src=\"images/emoticons/14.gif\" border = \"0\" alt =\":twisted:\">", 
	  "<img src=\"images/emoticons/15.gif\" border = \"0\" alt =\":roll:\">",
	  "<img src=\"images/emoticons/21.gif\" border = \"0\" alt =\"[image]\">",
	  "<img src=\"images/emoticons/16.gif\" border = \"0\" alt =\";)\">",
	  "<img src=\"images/emoticons/17.gif\" border = \"0\" alt =\":!:\">",
	  "<img src=\"images/emoticons/6.gif\" border = \"0\" alt =\":?:\">",
	  "<img src=\"images/emoticons/19.gif\" border = \"0\" alt =\":idea:\">",
	  "<img src=\"images/emoticons/20.gif\" border = \"0\" alt =\":arrow:\">",
	  "<img src=\"images/emoticons/22.gif\" border = \"0\" alt =\"=D>\">",
	  "<img src=\"images/emoticons/24.gif\" border = \"0\" alt =\"=P~\">",
	  "<img src=\"images/emoticons/26.gif\" border = \"0\" alt =\":-B\">",
	  "<img src=\"images/emoticons/27.gif\" border = \"0\" alt =\"=))\">",
	  "<img src=\"images/emoticons/29.gif\" border = \"0\" alt =\":-&\">",
	  "<img src=\"images/emoticons/30.gif\" border = \"0\" alt =\":>\">",
	  "<img src=\"images/emoticons/31.gif\" border = \"0\" alt =\":-O\">",
	  "<img src=\"images/emoticons/33.gif\" border = \"0\" alt =\":-?\">",
	  "<img src=\"images/emoticons/34.gif\" border = \"0\" alt =\":-S\">"
	  );
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}//end function

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
 
//Cleaning form inputs
function clean_it($vName) { 
  $vName = trim($vName); 
  $vName = nl2br($vName); 
  $vName = htmlentities($vName); 
  $vName = str_replace("&lt;br /&gt;", " ", $vName);
  return $vName; 
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
    <td align=\"right\"><b>*Email Address:</b></td>
    <td><input type=\"text\" name=\"email_conf\" value=\"\"></td>
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
    <td colspan=\"2\" align=\"center\"><b>Visual Confirmation:</b><br><img src=\"includes/visual_conf.php\" alt=\"\"><br><h6 style=\"font-size:10pt;font-weight:normal;margin:6px\">Code is case-sensitive.</h6><input type=\"text\" name=\"code_confirm\"></td>
  </tr>
  <tr>
    <td align=\"right\"><b>Name:</b></td>
    <td><input type=\"text\" name=\"Name\" value=\"$Name\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"2\"><b>Use Avatar hosting:</b> <input type=\"checkbox\" name=\"AvatarHost\" value=\"True\"></td>
  </tr>
  <tr>
    <td align=\"center\" colspan=\"2\"><b>Show Email:</b> <input type=\"checkbox\" name=\"ShowEmail\" value=\"True\"><br><input type=\"hidden\" name=\"mode\" value=\"submit\"><a href=\"KimPossibleFanWorldPPandTOS.pdf\">Read Terms and Conditions (PDF)</a><br>After Registering you will receive an e-mail with an activation link to activate your account<br>If you are experiencing issues activating your account or did not receive an e-mail please contact <a href=\"mailto:staff@kpfanworld.com?subject=User Activation Issues\">Staff@kpfanworld.com</a><br><br><input type=\"submit\" value=\"Register\"></td>
  </tr>
</table>".$_SESSION['visual_confirmattion']."
</form></center>";
   }

// Header/footer functions
function incheader($page)
  {
    $pagename = $page;
    include("includes/header.inc");
  }

function incheader_admin($page)
  {
    $pagename = $page;
    include("admin/header.inc");
  }
  
function footer()
  {
    include("includes/footer.inc");
    exit;
  }

// Admin Control Panel page inclusion
function admin($page)
  {
    include("admin/$page.php");
  }
?>
