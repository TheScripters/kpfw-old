<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******pmaction.php*************/
include("includes/functions.php");

if (isset($_SESSION['logged_in']) && isset($_GET['mode']))
  {
    if ($_GET['mode'] == "delete" && isset($_GET['id']))
      {
        $PMInfo = mysql_fetch_array(mysql_query("SELECT Subject FROM kpfw_privmsg WHERE MsgID = '".$_GET['id']."'"));
        incheader("Delete Message");
        echo "<h2>Confirm Deletion</h2>";
        echo "<br><br><center>Are you sure you wish to delete the selected message?<br><br>";
        echo "<b>".$PMInfo['Subject']."</b><br><br>";
        echo "<input type=\"button\" value=\"Cancel\" onclick=\"window.location='privmsg.php?id=".$_GET['id']."'\">&nbsp;&nbsp;<input type=\"button\" value=\"Delete\" onclick=\"window.location='pmaction.php?mode=delcon&id=".$_GET['id']."'\"><br></center>";
        footer();
      }
    if ($_GET['mode'] == "delcon" && isset($_GET['id']))
      {
        $sql = mysql_query("DELETE FROM kpfw_privmsg WHERE MsgID = '".$_GET['id']."'");
        $sql = mysql_query("DELETE FROM kpfw_pmsgtext WHERE MsgID = '".$_GET['id']."'");
        incheader("Delete Message");
        echo "<h2>Message Deleted</h2>";
        echo "<center><br>Selected message has been deleted.<br><br><a href=\"privmsg.php\">Click here</a> to go back to private messages.<br><a href=\"index.php\">Click here</a> to go back to main page.<br><br></center>";
        footer();
      }
    if ($_GET['mode'] == "reply" && isset($_GET['id']))
      {
        $PMInfo = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_privmsg WHERE MsgId = '".$_GET['id']."'"));
        $Receipt = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$PMInfo['From_User']."'"));
        $MsgText = mysql_fetch_array(mysql_query("SELECT Msg_Text FROM kpfw_pmsgtext WHERE MsgID = '".$_GET['id']."'"));
        incheader("Compose Message");
        include("includes/privmsg_reply.php");
        footer();
      }
    if ($_GET['mode'] == "send")
      {
        $now = time();
        $Receipt = mysql_fetch_array(mysql_query("SELECT UserId,UserEmail FROM kpfw_users WHERE UserName = '".$_REQUEST['rptName']."'"));
        $sql = mysql_query("INSERT INTO kpfw_privmsg VALUES (NULL, '".$_SESSION['userID']."', '".$Receipt['UserId']."', '".$_REQUEST['Subject']."', '".$now."', '1', '0')");
        $MsgID = mysql_insert_id();
        $sql1 = mysql_query("INSERT INTO kpfw_pmsgtext VALUES ('".$MsgID."', '".$_REQUEST['MsgText']."')");
        mail("".$_GET['rptName']." <".$Receipt['UserEmail'].">","New private message on KPFanWorld.com From ".$_SESSION['UserName']."",strip_gpc_slashes("Hello ".$_REQUEST['rptName'].",\n\n".$_SESSION['UserName']." has sent you a private message on KPFanWorld.com.\n\nSubject: ".$_REQUEST['Subject']."\n\nGo here and login to view: http://www.kpfanworld.com/privmsg.php?id=".$MsgID."\n\nThank you\nManagement\nKim Possible Fan World"), "From: webmaster@kpfanworld.com");
        if ($_GET['send'] == "reply")
          {
            $reply = mysql_query("UPDATE kpfw_privmsg SET Replied = '1' WHERE MsgID = '".$_REQUEST['origMsgID']."'");
          }
        incheader("Compose Message");
        echo "<h2>Message Sent</h2>";
        echo "<br><center>Your message has been sent successfully!</center><br><br><br>";
        footer();
      }
    if ($_GET['mode'] == "compose")
      {
        incheader("Compose Message");
        include("includes/privmsg_send.php");
        footer();
      }
  }
if (!isset($_SESSION['logged_in']))
  {
    header("Location: login.php?r=pmaction.php?mode=".$_GET['mode']."&id=".$_GET['id']."");
  }
if (isset($_SESSION['logged_in']) && !isset($_GET['mode']) && isset($_GET['id']))
  {
    incheader("Error");
    echo "<center>Action on selected message not chosen! Please try again or contact <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>.";
    echo "<br><br><br>";
    footer();
  }
if (isset($_SESSION['logged_in']) && $_GET['mode'] != "compose" && !isset($_GET['id']))
  {
    incheader("Error");
    echo "<center>No message selected!  Please try again or contact <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>.";
    echo "<br><br><br>";
    footer();
  }
?>
