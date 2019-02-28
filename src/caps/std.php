<?php
// Code © 2006 Adam Humpherys
// http://www.adamh.us; adam@adamh.us
/********index.php***********/
$episode_page_name = "The Kim Possible Movie So the Drama";
include ("header.inc");
if (!$_GET['start'])
  {
  ?>
<table width="75%" align="center">
  <tr>
    <td><center><a href="index.php">Home</a><br />
	<font face="Arial Black" size="4">Screen Caps for The Kim Possible Movie So the Drama</font></center><br />
    <table width="80%" align="center" border="1" style="border-collapse: collapse">
      <tr>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1">1-100</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/101">101-200</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/201">201-300</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/301">301-400</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/401">401-500</a></td>
      </tr>
      <tr>
        <td align="center"><a href="http://caps.kpfanworld.com/std/501">501-600</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/601">601-700</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/701">701-800</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/801">801-900</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/901">901-1000</a></td>
      </tr>
      <tr>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1001">1001-1100</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1101">1101-1200</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1201">1201-1300</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1301">1301-1400</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1401">1401-1500</a></td>
      </tr>
      <tr>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1501">1501-1600</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1601">1601-1700</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1701">1701-1800</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1801">1801-1900</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/1901">1901-2000</a></td>
      </tr>
      <tr>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2001">2001-2100</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2101">2101-2200</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2201">2201-2300</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2301">2301-2400</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2401">2401-2500</a></td>
      </tr>
      <tr>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2501">2501-2600</a></td>
        <td align="center"><a href="http://caps.kpfanworld.com/std/2601">2601-2700</a></td>
        <td></td>

        <td></td>
        <td></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
  <?php
  }
if ($_GET['start'])
  {
    $start = $_GET['start'];
    $page = $start + 100;
    $prev = $start - 100;
    $next = $start + 100;
    $till = $start + 99;
    echo "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/std\">Episode Index</a>&nbsp;&nbsp;&nbsp;";
	(file_exists("caps/Image".$prev.".jpg")) ? print "<a href=\"http://caps.kpfanworld.com/std/".$prev."\">Previous Page</a>&nbsp;&nbsp;&nbsp;" : print "";
    (file_exists("caps/Image".$next.".jpg")) ? print "<a href=\"http://caps.kpfanworld.com/std/".$next."\">Next Page</a>" : print "";
	print "<br /><font face=\"Arial Black\" size=\"4\">Screen Caps ".$start."-".$till." for The Kim Possible Movie So the Drama</font></center>";
    echo "<table width=\"75%\" align=\"center\">";
    $picInRow = 1;
    for ($i=$start;$i<$page;$i++)
     {
       if ($picInRow == 1)
         {
  	       echo "<tr>";
         }
       echo "<td>";
       echo "<a href=\"http://caps.kpfanworld.com/view/std/Image".$i.".jpg\" target=\"blank\"><img src=\"http://caps.kpfanworld.com/cap_thumbs/Image".$i.".jpg\" alt=\"Click to open full image in a new window.\" border=\"0\" /></a>";
       echo "</td>";
       $picInRow = $picInRow + 1;
       if ($picInRow == 5)
         {
           echo "</tr>\n";
           $picInRow = 1;
         }
     }
    echo "</table>";
    echo "<center><a href=\"http://caps.kpfanworld.com/index.php\">Home</a>&nbsp;&nbsp;&nbsp;<a href=\"http://caps.kpfanworld.com/std\">Episode Index</a>&nbsp;&nbsp;&nbsp;";
	(file_exists("caps/Image".$prev.".jpg")) ? print "<a href=\"http://caps.kpfanworld.com/std/".$prev."\">Previous Page</a>&nbsp;&nbsp;&nbsp;" : print "";
    (file_exists("caps/Image".$next.".jpg")) ? print "<a href=\"http://caps.kpfanworld.com/std/".$next."\">Next Page</a>" : print "";
	print "<br /><font face=\"Arial Black\" size=\"4\">Screen Caps ".$start."-".$till." for The Kim Possible Movie So the Drama</font></center>";
  }
include ("footer.inc");
?>
