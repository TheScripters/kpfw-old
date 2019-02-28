<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******timeline.php*************/
include("includes/functions.php");
incheader("KP Timeline");
include("includes/guides_table.inc");
$sql = mysql_query("SELECT News_ID,Month_Day,Year,News_Text FROM kpfw_today ORDER BY Date ASC");
?><br><a href="eplist">Back to Guides</a>
<br><br>
<table align="center" border="1" width="50%">
  <tr>
    <td><br>
      <ul style="list-style:none">
      <?php
      while($timeline = mysql_fetch_array($sql))
        {
          echo "\t<li><b>".$timeline['Month_Day'].", ".$timeline['Year']."</b> -- ";
          echo $timeline['News_Text']."<br>";
          if ($_SESSION['logged_in'])
            {
              echo "<a href=\"editevent.php?id=".$timeline['News_ID']."\">Edit This Event</a><br>";
            }
          echo "<br></li>\n";
        }
      ?>
      </ul>
      <?php
      if ($_SESSION['logged_in'])
        {
        ?><center>
      <form action="addevent.php" method="post">
      <b>Date:</b> <input type="text" name="date" value="<?=gmdate("M d Y",time()+$_SESSION['TZone'])?>"><br>
      <b>Event:</b> <input type="text" name="event"><br>
      <input type="submit" value="Submit Event">
      </form></center><?php
          echo "\n";
        }
      ?>
    </td>
  </tr>
</table>
<br>
<?php
footer();
?>
