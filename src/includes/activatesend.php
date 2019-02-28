<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******activatesend.php*********/
$send = mysql_fetch_array(mysql_query("SELECT Config_Value AS value FROM kpfw_config WHERE Config_ID = 'ActivateSend'"));
$cfgvalue = explode(",",$send['value']);
$months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
$date = date("M d Y");
$date = str_replace($months,$replace,$date);
$date = explode(" ",$date);
$today = time();
if ($today >= $cfgvalue[2])
  {
    $sql = mysql_query("SELECT UserName,UserEmail,UserId,Act_Key FROM kpfw_users WHERE Active = '0'");
    while($mail = mysql_fetch_array($sql))
      {
        $headers_html = "Reply-to: staff@kpfanworld.com\nFrom: staff@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n";
        $header = "<html>\n<head>\n<style type=\"text/css\">\nH1 {font-variant: small-caps; color: #FFFFFF; font-size: 36pt; text-decoration: underline; font-family: Arial; font-style: italic; text-align: center}
H2 {text-decoration: underline; font-size: 26pt; font-variant: small-caps; text-align: center; color: #FFFFFF; font-family: Arial}
H3 {color: #FFFFFF; font-family: Arial; font-size: 18pt; text-align: center}
H6 {color: #FFFFFF; font-weight: normal; text-align: center}
TH {color: #FFFFFF; font-size: 20pt; text-decoration: underline}
TH.privmsg {color: #FFFFFF; font-size: 28pt; font-weight: bold; font-style: italic}
TH.forum {color: lime; font-size: 16pt; text-align:center}
TD.link {font-size: 12pt; text-align: center}
P {text-indent: 20px; font-family: Arial; color: #FFFFFF; font-size: 12pt}
A:link {color: #FFFF00}
A:visited {color: #66CC66}
A:active {color: #000000; background: #669966}
A:hover {text-decoration: none}
.text {color: #FFFFFF; font-family: Arial; font-size: 10pt}
BODY {background-color: #000000; color: #FFFFFF}\n</style>\n<base href=\"http://www.kpfanworld.com/\" target=\"_blank\">\n</head>\n<body>
<br><br><center><a href=\"http://www.kpfanworld.com\"><img src=\"images/kimweb.png\" border=\"0\"></a></center>";
        mail($mail['UserEmail'],"Activation Reminder For KP Fan World",$header."<br><h1>Activation Reminder</h1><br><table align=\"center\" width=\"65%\">\n<tr>\n<td>Do not be alarmed by this message, ".$mail['UserName'].". This email is simply to remind you that you have not yet activated your account on KP Fan World. You can use the link below to do so:<br><br><a href=\"http://www.kpfanworld.com/activate.php?user=".$mail['UserId']."&code=".$mail['Act_Key']."\">http://www.kpfanworld.com/activate.php?user=".$mail['UserId']."&code=".$mail['Act_Key']."</a><br><br>If you are having issues activating your account try copying and pasting the activate URL into your browser's address bar or please contact <a href=\"mailto:staff@kpfanworld.com?subject=User Activation Issues\">staff@kpfanworld.com</a> for help<br><br>Thanks,<br>KP Fan World Staff<br><a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a></td></tr></table><br><br><hr><h6>&copy; 2006 KP Fan World<br>\"Kim Possible\" &copy 2002-2006 Walt Disney</h6></body></html>",$headers_html);
      }
    $nextmail = mktime(18,30,0,$date[0],$date[1],$date[2]) + $cfgvalue[0];
    $update = mysql_query("UPDATE kpfw_config SET Config_Value = '".$cfgvalue[0].",".$today.",".$nextmail."' WHERE Config_ID = 'ActivateSend'");
  }
?>
