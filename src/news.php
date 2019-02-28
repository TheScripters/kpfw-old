<?php
// Code © 2007 KP Fan World.com
// Code written by Adam Humpherys
/*******news.php*****************/
include "includes/functions.php";
incheader("KP News");
?>
<h2>Latest News</h2><br>
<table align="center" width="45%">
<?php
$newscnt = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpfw_news"));
if ($newscnt['cnt'] == 0) {
  echo "  <tr>\n    <td align=\"center\"><b>No News Stories Available</b></td>\n  </tr>";
} elseif ($newscnt['cnt'] >= 1) {
  $story = ($newscnt['cnt'] == 1) ? "Story" : "Stories";
  echo "  <tr>\n    <td align=\"center\"><b>Total of ".$newscnt['cnt']." News ".$story." Available</b></td>\n  </tr>\n";
  echo "  <tr>\n    <td height=\"15\"></td>\n  </tr>\n";
  $newssql = mysql_query("SELECT * FROM kpfw_news ORDER BY Date DESC Limit 10");
  while($news = mysql_fetch_array($newssql))
    {
      echo "  <tr>\n    <td align=\"center\"><b>".date("d M Y",$news['Date'])."</b><br>\n";
      echo $news['NewsText']."<br>\n";
      echo "<a href=\"".$news['Link']."\" target=\"_blank\">Read More...</a></td>\n";
      echo "  </tr>\n";
      echo "  <tr>\n    <td height=\"15\"><hr size=\"2\" width=\"50%\" color=\"#00FF00\"></td>\n";
      echo "  </tr>\n";
    }
  if ($_SESSION['logged_in']) {
    echo "<!-- Submission Form -->";
  }
}
?>
</table><br><br>
<?php
footer();
?>
