<?php
// Filename: rss.php
// Coded by: Adam Humpherys
// (c) 2009 KPFanFiction.com
$date = date("D\, j M Y H:i:s T");
define('DB_READY',TRUE);
include("includes/db.php");
$xml_header = 'xml version="1.0"';
header("Content-Type: application/xml");
echo '<'.'?xml version="1.0" encoding="UTF-8"?'.'>';
/*$rssLength = mysql_query("SELECT Value FROM kpff_config WHERE Id = 'RSSLength'",$connect);
while($row = mysql_fetch_array($rssLength))
  {
    $rss = $row['Value'];
  }*/
$rss = 15;
?>
<rss version="2.0">
  <channel>
    <title>Kim Possible Fanfiction</title>
    <description>KPFanFiction.com <?echo$rss?> newest stories.</description>
    <link>http://www.kpfanfiction.com</link>
    <copyright>Copyright 2005 Kim Possible Fanfiction</copyright>
    <language>en-us</language>
    <lastBuildDate><?echo$date?></lastBuildDate>
    <webMaster>editors@kpfanfiction.com</webMaster>
    <?php $result = mysql_query("SELECT * FROM kpfw_ffchapter ORDER BY Date DESC LIMIT 0,$rss");
    while($myrow = mysql_fetch_array($result))
       {
         $ficTitle = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_fftitles WHERE FF_Id = '".$myrow['FicId']."'"));
         echo "\t\t<item>\n";
         echo "\t\t\t<title>";
         echo $ficTitle['Title'];
         echo "</title>\n";
         echo "\t\t\t<description>";
         echo $ficTitle['Title'];
         echo " - ";
         echo $myrow['ChapterTitle'];
         echo ")</description>\n";
         echo "\t\t\t<pubDate>";
         echo date("r",$myrow['Date']);
         echo "</pubDate>\n";
         echo "\t\t\t<link>http://www.kpfanfiction.com/fic/";
         echo $myrow['FicId']."/".$myrow['Chapter'];
         echo "</link>\n";
         echo "\t\t</item>\n";
       }
    ?>
  </channel>
</rss>

