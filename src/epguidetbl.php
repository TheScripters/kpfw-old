<?php
define('DB_READY',TRUE);
include("includes/db.php");
for($i=1;$i<73;$i++)
 {
   $sql = mysql_query("INSERT INTO kpfw_transcript VALUES ('".$i."', '')");
   echo $i."<br>";
 }
?>
