<?php
define("DB_READY",TRUE);
include "includes/db.php";
$authorsql = mysql_query("SELECT AuthorName,AuthorEmail FROM kpff_authors");
while($email = mysql_fetch_array($authorsql))
  {
    $authcnt = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpff_fics WHERE author = '".$email['AuthorName']."'"));
    if ($authcnt['cnt'] >= 1){
      mail($email['AuthorEmail'],"Important KP Fan Fiction Updates","Hello ".$email['AuthorName'].",\n\nThis important email is in reference to your account on KPFanFiction.com. KPFanFiction.com no longer exists as you knew it. This has been due to a lapse in memory and allowing the hosting to lapse.\n\nDo not worry, however. There is no need for concern because the site has been backed up to a new location temporarily: http://kpff.thescripters.net/\n\nTo get the full story and what you need to do, go here:\nhttp://ronstoppable.proboards89.com/index.cgi?board=polls&action=display&thread=10924&page=17#1336239\n\nThank you.","From: fanfic@kpfanworld.com\r\nx-Priority: 1");
    }
    echo $email['AuthorName']."=>".$email['AuthorEmail']."<br>\n";
  }
?>
