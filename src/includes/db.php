<?
if (!defined('DB_READY'))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
 else
  {
    /*$dbname = "thescrip_kpsite";
    $dbuser = "thescrip_kpsite";*/
    $dbname = "kpfanwor_kpsite";
    $dbuser = "kpfanwor_kpsite";
    $dbpass = "kpsite123";
    $host = "localhost";

    $connect = mysql_connect($host, $dbuser, $dbpass);
    mysql_select_db($dbname, $connect);
  }
?>
