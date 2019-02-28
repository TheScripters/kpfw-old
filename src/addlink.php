<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******addlink.php**************/
include("includes/functions.php");
//error_reporting(2047);
if (empty($_REQUEST['Link_Title']) || empty($_REQUEST['Link_URL']) && isset($_SESSION['logged_in']))
  {
    incheader("Add Link");
    echo "Required fields must be filled in.";
    echo "<form action=\"addlink.php\" method=\"post\">";
    echo "<b>Link Title:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_Title\" maxlength=\"45\" value=\"".$_REQUEST['Link_Title']."\"><br>";
    echo "<b>Link URL:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_URL\" maxlength=\"70\" value=\"".$_REQUEST['Link_URL']."\"><br>";
    echo "<b>Link Description:</b>&nbsp;&nbsp;<input type=\"text\" name=\"Link_Description\" maxlength=\"255\" value=\"".strip_gpc_slashes($_REQUEST['Link_Description'])."\"><br>";
    echo "<b>Banner:</b>&nbsp;&nbsp;<input type=\"text\" name=\"link_Banner\" maxlength=\"70\" value=\"".$_REQUEST['Link_Banner']."\"><br><br>";
    echo "<b>Category:</b>&nbsp;&nbsp;<select name=\"Link_Category\">";
    $CatSel = mysql_query("SELECT * FROM kpfw_linkcat ORDER BY CatID ASC");
    while ($Cat_Select = mysql_fetch_array($CatSel))
      {
        echo "<option name=\"Link_Category\" value=\"".$Cat_Select['CatID']."\">".$Cat_Select['Link_Cat']."</option>";
      }
     echo "<option name=\"Link_Category\" value=\"New\">New</option></select><br>";
     echo "<b>If New:</b>&nbsp;&nbsp;<input type=\"text\" name=\"new_select\" maxlength=\"35\"><br><br>";
     echo "<input type=\"submit\" value=\"Submit Link\"></form><br><br>";
     footer();
  }
if (!isset($_SESSION['logged_in']))
  {
    header("Location: login.php?r=links.php");
  }
if (!empty($_REQUEST['Link_Title']) && !empty($_REQUEST['Link_URL']) && isset($_SESSION['logged_in']))
  {
    if ($_REQUEST['Link_Category'] == "New")
      {
        $AddCat = mysql_query("INSERT INTO kpfw_linkcat VALUES (NULL, '".$_REQUEST['new_select']."')");
        $CatID = mysql_fetch_array(mysql_query("SELECT CatID FROM kpfw_linkcat WHERE Link_Cat = '".$_REQUEST['new_select']."'"));
        $Category = $CatID['CatID'];
      }
     else
      {
        $Category = $_REQUEST['Link_Category'];
      }
    $LinkAdd = mysql_query("INSERT INTO kpfw_links VALUES (Null, '$Category', '".$_REQUEST['Link_Title']."', '".$_REQUEST['Link_URL']."', '".$_REQUEST['Link_Description']."', '".$_REQUEST['Link_Banner']."', '0', '".$_SESSION['userID']."')");
    incheader("Add Link");
    echo "<br><br>Link successfully added!<br><a href=\"links.php\">Click here</a> to view.<br><br>";
    //mail_admin("Links","", "Catagory: $Category\n\n Link Title: ".$_REQUEST['Link_Title']."\n\n Link Description: ".$_REQUEST['Link_Description']."\n\n Link URL: ".$_REQUEST['Link_URL']."\n\n Link Banner Image: ".$_REQUEST['Link_Banner']."");
    mail("staff@kpfanworld.com","New Link Added To KP Fanworld","Hello,\n\nThis email is to inform you that a new link has been added by user ".$_SESSION['UserName']."\n Link Title: ".$_REQUEST['Link_Title']."\n Link Description: ".$_REQUEST['Link_Description']."\n Link URL: ".$_REQUEST['Link_URL']."\n Link Banner Image: ".$_REQUEST['Link_Banner']."\n\nThank You\nStaff@kpfanworld.com","Reply-to: staff@kpfanworld.com\nFrom: webmaster@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n");
    footer();
  }
?>
