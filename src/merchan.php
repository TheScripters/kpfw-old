<?php
include("includes/functions.php");
incheader("KP Merchandise");
if (!$_GET['mode']){
  	include("includes/guides_table.inc");
	$membercount = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS memcnt FROM kpfw_merchandise"));
	if ($membercount['memcnt'] >= 31 && $_GET['pagenum'])
	{
	    $multiplier = $_REQUEST['pagenum'] - 1;
	    $page = 30*$multiplier;
	}else{
	    $page = 0;
	}// end if
	$pagenum = (!$_GET['pagenum']) ? 1 : $_GET['pagenum']; 
	$memberlist = mysql_query("SELECT * FROM kpfw_merchandise ORDER BY ID ASC LIMIT $page,30"); 
	$range = ceil($membercount['memcnt'] / 30);
	print "<table border=\"0\">";
	
	//prints out pageination links
	
	$next = ($_GET['pagenum'] >= 2) ? $_GET['pagenum']+1 : 2;
	echo "<tr><td align=\"left\" colspan=\"2\">";
	($_GET['pagenum'] >= 2) ? print "<a href=\"merchandise/".$multiplier."\">Previous Page</a>" : "";
	echo "</td><td align=\"center\" colspan=\"4\">";
	for ($i=1;$i<=$range;$i++)
	{
	    $j = ($i != $range) ? "&nbsp;&nbsp;" : "";
	    if ($i == $pagenum)
		{
	        echo $i.$j;
	    } else {
	        echo "<a href=\"merchandise/".$i."\">".$i."</a>".$j;
	    }
	}
	echo "</td><td align=\"right\" colspan=\"2\">";
	($membercount['memcnt'] >= $page+30) ? print "<a href=\"merchandise/".$next."\">Next Page</a>" : "";
	echo "</td></tr></table><table border=\"0\">";
	       
	       
	while($list = mysql_fetch_array($memberlist))
	{
	  	if (($list['ID'] % 2)==1){
	  	  print"<tr><td><a href=\"merchandise/view/$pagenum/".$list['ID'].".jpg\"><img src=\"images/merchan/thumbs/".$list['ID'].".jpg\" title=\"Click to view Full Size\" alt=\"[image]\" border=\"0\"></a></td>";
		}else{
		  print "<td><a href=\"merchandise/view/$pagenum/".$list['ID'].".jpg\"><img src=\"images/merchan/thumbs/".$list['ID'].".jpg\" title=\"Click to view Full Size\" alt=\"[image]\" border=\"0\"></a></td></tr>";
		}
	}
	print "</table><table border=\"0\">";
	
	//prints out pageination links
	
	$next = ($_GET['pagenum'] >= 2) ? $_GET['pagenum']+1 : 2;
	echo "<tr><td align=\"left\" colspan=\"2\">";
	($_GET['pagenum'] >= 2) ? print "<a href=\"merchandise/".$multiplier."\">Previous Page</a>" : "";
	echo "</td><td align=\"center\" colspan=\"4\">";
	for ($i=1;$i<=$range;$i++)
	{
	    $j = ($i != $range) ? "&nbsp;&nbsp;" : "";
	    if ($i == $pagenum)
		{
	        echo $i.$j;
	    } else {
	        echo "<a href=\"merchandise/".$i."\">".$i."</a>".$j;
	    }
	}
	echo "</td><td align=\"right\" colspan=\"2\">";
	($membercount['memcnt'] >= $page+30) ? print "<a href=\"merchandise/".$next."\">Next Page</a>" : "";
	echo "</td></tr></table>";
}else if ($_GET['mode'] == "view"){
  print "<center><br><br><a href=\"merchandise/".$_GET['pagenum']."\">Back</a><br><br>
  <img src=\"images/merchan/".$_GET['pic']."\" alt=\"".$_GET['pic']."\" border=\"0\"></center>";
}//end if
footer();
?>