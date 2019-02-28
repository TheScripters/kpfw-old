<?php
//error_reporting(E_ALL ^ E_NOTICE);
$timenow = time();
$timezone = 3600*(-6.00);
$timeoffset = gmdate("M d Y g:i:s A",time()+$timezone);
echo "<b>UNIX Timestamp:</b> ".$timenow."<br>";
echo "<b>Time Zone:</b> ".$timezone."<br>";
echo "<b>Local Time:</b> ".$timeoffset."<br>";
echo "<b>Server Time:</b> ".date("M d Y g:i:s A", $timenow);
?>
