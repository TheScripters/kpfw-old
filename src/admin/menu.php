<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******admin/menu.php***********/
if (!defined("Admin"))
  {
    header("HTTP/1.1 404 Not Found");
    (file_exists("../404.shtml")) ? include("../404.shtml") : include("404.shtml");
    exit;
  }
?>
<table width="100%">
  <tr>
    <td width="180" valign="top"><ul><li><a href="admin.php">Admin Home</a></li><center><hr width="75%"></center><h4>Configuration</h4>
      <li><a href="admin.php?page=meta">Meta Tags</a></li>
      <li><a href="admin.php?page=index_news">Index News</a></li>
      <li><a href="admin.php?page=countdown">Countdown Config</a></li>
      <center><hr width="75%"></center>
      <h4>Ban System</h4>
      <li><a href="admin.php?page=ipbans">IP Banning</a></li>
      <li><a href="admin.php?page=userbans">User Banning</a></li><center><hr width="75%"></center>
      <h4>Users</h4>
      <li><a href="admin.php?page=avhost">Avatar Hosting Managment</a></li>
      <li><a href="admin.php?page=users">User Management</a></li>
      <li><a href="admin.php?page=promote">User Levels</a></li>
      <li><a href="admin.php?page=email">Mass Email</a></li>
      <li><a href="admin.php?page=member">Members List</a></li>
      <li><a href="admin.php?page=activate">Activation Reminders</a></li><center><hr width="75%"></center>
      <h4>Links</h4>
      <li><a href="admin.php?page=links">Link Management</a></li>
      <li><a href="admin.php?page=lcat">Categories</a></li><center><hr width="75%"></center>
      <h4>Admins</h4>
      <li><a href="admin.php?page=message">Message Area</a></li>
      <li><a href="admin.php?page=acp">ACP Message</a></li></ul></td>
    <td valign="top">
