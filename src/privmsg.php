<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******privmsg.php**************/
include("includes/functions.php");
if (!isset($_SESSION['logged_in']) && !isset($_GET['id']))
  {
    header("Location: login.php?r=privmsg.php");
  }
if (!isset($_SESSION['logged_in']) && isset($_GET['id']))
  {
    header("location: login.php?r=privmsg.php?id=".$_GET['id']."");
  }
if (isset($_SESSION['logged_in']) && isset($_GET['id']))
  {
    $pmID = $_REQUEST['id'];
    $PMInfo = mysql_fetch_array(mysql_query("SELECT * FROM kpfw_privmsg WHERE MsgID = '$pmID'"));
    $PMText = mysql_fetch_array(mysql_query("SELECT Msg_Text FROM kpfw_pmsgtext WHERE MsgID = '$pmID'"));
    $PMFrom = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$PMInfo['From_User']."'"));
    $MsgText = nl2br(bbcode($PMText['Msg_Text']));
    incheader("Reading Message: ".$PMInfo['Subject']."");
    include("includes/privmsg_text.php");
    footer();
  }
if (isset($_SESSION['logged_in']) && !isset($_GET['id']))
  {
    /*$pmcount = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS pmcnt FROM kpfw_privmsg WHERE To_User = '".$_SESSION['userID']."'"));
    $pagelimit = mysql_fetch_array(mysql_query("SELECT Config_Value AS Limit FROM kpfw_config WHERE Config_ID = 'Page_Limit'"));
    if (isset($_GET['page']))
      {
        if ($pmcount['pmcnt'] >= $pagelimit['Limit'] + 1)
          {
            $multiplier = $_REQUEST['page'] - 1;
            $page = $pagelimit['Limit']*$multiplier+1;
          }
         else
          {
            $page = 1;
          }
      }*/
    incheader("View Private Messages");
    //$PMSQL = mysql_query("SELECT * FROM kpfw_privmsg WHERE To_User = '".$_SESSION['userID']."' ORDER BY MsgID DESC LIMIT $page,".$pagelimit['Limit']."");
    $PMSQL = mysql_query("SELECT * FROM kpfw_privmsg WHERE To_User = '".$_SESSION['userID']."' ORDER BY MsgID DESC LIMIT 30");
    include("includes/pm_header.inc");
    while($PMInfo = mysql_fetch_array($PMSQL))
      {
        $From = mysql_fetch_array(mysql_query("SELECT UserName FROM kpfw_users WHERE UserId = '".$PMInfo['From_User']."'"));
        $new = ($PMInfo['New'] == "1") ? "new" : "old";
        include("includes/pm_list.inc");
      }
    include("includes/pm_footer.inc");
    footer();
  }
?>
