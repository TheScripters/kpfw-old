<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/index.php********/
define('Admin',True);
include("includes/functions.php");
if (!isset($_SESSION['logged_in']))
  {
    header("Location: login.php?r=".$_SERVER['REQUEST_URI']);
  }
if (isset($_SESSION['logged_in']))
  {
    if ($_SESSION['UserLevel'] <= "2")
      {
        header("Location: index.php");
      }
    if ($_SESSION['UserLevel'] == "3")
      {
        (!$_GET['mode']) ? incheader_admin("Administration") : "";
        if (isset($_GET['page']))
          {
            admin("".$_GET['page']."");
          }
         else
          {
            admin("main");
          }
        footer();
      }
  }
?>
