<?php
// Code © 2006-2007 KPFanWorld.com
// Code written by Adam Humpherys
/*******usrbarup.php*************/
include("includes/functions.php");
if (!$_GET['mode']){
  echo "<form action=\"usrbarup.php?mode=upload\" method=\"post\" enctype=\"multipart/form-data\">\n";
  echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"5242880\">\n";
  echo "<input type=\"file\" name=\"bar\"><br>\n";
  echo "<input type=\"submit\" value=\"Submit\"></form>";
  exit;
} elseif ($_GET['mode'] == "upload"){
  ini_set("upload_max_filesize","5242880");
  $dir = "/home/kpfanwor/public_html/vip_hosting/";
  $newfile = $dir.basename($_FILES['bar']['name']);
  move_uploaded_file($_FILES['bar']['tmp_name'], $newfile);
  echo "<code>http://www.kpfanworld.com/vip_hosting/".basename($_FILES['bar']['name'])."</code><br><br>";
  echo "<form action=\"usrbarup.php?mode=upload\" method=\"post\" enctype=\"multipart/form-data\">\n";
  echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"5242880\">\n";
  echo "<input type=\"file\" name=\"bar\"><br>\n";
  echo "<input type=\"submit\" value=\"Submit\"></form>";
  echo "<pre>";
  print_r($_FILES);
  echo "</pre>";
}
?>
