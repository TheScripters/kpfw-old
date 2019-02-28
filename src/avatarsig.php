<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******avatarsig.php************/
include("includes/functions.php");
if ($_GET['mode'] == "userbars")
  {
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_userbars"));
    $barcount = round($count['count'] / 2);
    $barcnt = $count['count'] - $barcount;
    incheader("Userbars");
    echo "<br><br><center>Userbars are here!<br>Just click on the text field underneath the image you wish to use and hit ctrl+c (for Windows) and then paste it into your signature area.<br><br>There are ".$count['count']." userbars currently online.<br><br>\n";
    $user = mysql_query("SELECT * FROM kpfw_userbars ORDER BY BarName ASC LIMIT 0,".$barcount."");
    echo "<table width=\"75%\" align=\"center\"><tr><td align=\"center\" width=\"50%\">";
    while($bar = mysql_fetch_array($user))
      {
        echo "<font size=\"+1\" color=\"lime\">".$bar['BarName']."</font><br><img src=\"userbars/".$bar['BarFileName']."\" border=\"0\" alt=\"\"><br><input type=\"text\" readonly size=\"50\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/userbars][img]http://www.kpfanworld.com/userbars/".$bar['BarFileName']."[/img][/url]\"><br><br><hr width=\"65%\"><br>\n\n";
      }
    echo "</td><td align=\"center\" width=\"50%\" valign=\"top\">";
    $user1 = mysql_query("SELECT * FROM kpfw_userbars ORDER BY BarName ASC LIMIT ".$barcount.",".$barcnt."");
    while($bar1 = mysql_fetch_array($user1))
      {
        echo "<font size=\"+1\" color=\"lime\">".$bar1['BarName']."</font><br><img src=\"userbars/".$bar1['BarFileName']."\" border=\"0\" alt=\"\"><br><input type=\"text\" readonly size=\"50\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/userbars][img]http://www.kpfanworld.com/userbars/".$bar1['BarFileName']."[/img][/url]\"><br><br><hr width=\"65%\"><br>\n\n";
      }
    echo "</td></tr></table></center>";
  }
 elseif ($_GET['mode'] == "avatars")
  {
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM kpfw_avatars"));
    incheader("Avatars");
    echo "<br><br><center>Avatars are now available!<br>You can either save and upload or link directly (most forums allow either one or both). To link directly, just copy the text in the text field of the avatar you wish to use.</center><br><br>";
    echo "<table width=\"75%\" align=\"center\">";
    $picInRow = 1;
    $avsql = mysql_query("SELECT * FROM kpfw_avatars ORDER BY Avatar_Name ASC");
    while($avatar = mysql_fetch_array($avsql))
    //for ($i=1;$i<$count['count'];$i++)
     {
       //$avatar = mysql_fetch_array(mysql_query("SELECT Avatar_Name,Avatar_FileName FROM kpfw_avatars WHERE Avatar_ID = '".$i."'"));
       if ($picInRow == 1)
         {
  	       echo "<tr>";
         }
       echo "<td align=\"center\">";
       echo "<img src=\"avatars/".$avatar['Avatar_FileName']."\" alt=\"".$avatar['Avatar_Name']."\"><br>";
       echo "<input type=\"text\" value=\"http://www.kpfanworld.com/avatars/".$avatar['Avatar_FileName']."\" title=\"".$avatar['Avatar_Name']."\" onfocus=\"javascript:this.select()\" readonly size=\"20\">";
       echo "</td>";
       $picInRow = $picInRow + 1;
       if ($picInRow == 6)
         {
           echo "</tr>\n";
           $picInRow = 1;
         }
     }
    echo "</table><br><br>";
  }
footer();
?>
