<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******links.php****************/
include("includes/functions.php");
incheader("Links");
if (isset($_SESSION['logged_in'])){
  	print "<center><br><b>Please go to bottom of page to add links</b></center>";
}else{
    print "<center><br><b>Please Log in to add Links</b></center>";
}
echo "<table width=\"50%\">";
$linkCat = mysql_query("SELECT * FROM kpfw_linkcat ORDER BY Link_Cat ASC");
while ($LinkCat = mysql_fetch_array($linkCat))
  {
    $Links = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS Links FROM kpfw_links WHERE CatID = '".$LinkCat['CatID']."'"));
    if ($Links['Links'] >= "2" || $Links['Links'] == "0")
      {
        $Link_S = "Links";
      }
     else
      {
        $Link_S = "Link";
      }
    $Link = mysql_query("SELECT * FROM kpfw_links WHERE CatID = '".$LinkCat['CatID']."' ORDER BY LinkTitle ASC");
    echo "<tr><td align=\"center\"><h2>".$LinkCat['Link_Cat']." (<i>".$Links['Links']." $Link_S</i>)</h2></td></tr><tr><td>";
    echo "<ul style=\"list-style: none\">";
    while ($Linkage = mysql_fetch_array($Link))
      {
        echo "<li>";
        if (!empty($Linkage['Banner']))
          {
            echo "<a href=\"".htmlspecialchars("link.php?id=".$Linkage['LinkID'])."\" target=\"_blank\" title=\"".$Linkage['LinkTitle']."\" onmouseover=\"javascript:window.status='Go to ".addslashes($Linkage['LinkTitle'])."';return true\" onmouseout=\"javascript:window.status='';return true\"><img src=\"".$Linkage['Banner']."\" alt=\"Banner for ".$Linkage['LinkTitle']."\" border=\"0\"></a><br>";
          }
        echo "<b>".$Linkage['LinkTitle']."</b> -- <i>Hits:</i> ".$Linkage['Hits']."<br>";
        echo bbcode(stripslashes($Linkage['LinkDescription']));
        echo "<br><a href=\"".htmlspecialchars("link.php?id=".$Linkage['LinkID'])."\" target=\"_blank\" title=\"".$Linkage['LinkTitle']."\" onmouseover=\"javascript:window.status='Go to ".addslashes($Linkage['LinkTitle'])."';return true\" onmouseout=\"javascript:window.status='';return true\">Visit this site...</a> || <span style=\"cursor:hand;color:#FFFF00\" onclick=\"window.open('report.php?link=".$Linkage['LinkID']."','','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=no,width=493,height=270');\">Report Broken</span><br><br></li>";
      }
    echo "</ul></td></tr>";
  }
echo "</table>";
if (isset($_SESSION['logged_in']))
  {
    echo "<form action=\"addlink.php\" method=\"post\">";
    echo "<b>Link Title:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_Title\" maxlength=\"45\"><br>";
    echo "<b>Link URL:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_URL\" maxlength=\"70\" value=\"http://\"><br>";
    echo "<b>Link Description:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_Description\" maxlength=\"255\"><br>\n";
    echo "<b>Banner:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_Banner\" maxlength=\"70\"><br>(500x100 max size)<br><br>\n";
    echo "<b>Category:</b>&nbsp;&nbsp;<select name=\"Link_Category\">";
    $CatSel = mysql_query("SELECT * FROM kpfw_linkcat ORDER BY CatID ASC");
    while ($Cat_Select = mysql_fetch_array($CatSel))
      {
        echo "<option name=\"Link_Category\" value=\"".$Cat_Select['CatID']."\">".$Cat_Select['Link_Cat']."</option>";
      }
     echo "<option name=\"Link_Category\" value=\"New\">New</option></select><br>";
     echo "<b>If New:</b>&nbsp;&nbsp;<input type=\"text\" name=\"new_select\" maxlength=\"35\"><br><br>";
     echo "<input type=\"submit\" value=\"Submit Link\"></form>
	 <b><u>All submitted links are subject to approval by an administrator. If your link is deleted or modified, an admin has done so. If you want more information as to why please contact staff@kpfanworld.com</u></b><br><br>";
  }
footer();
?>
