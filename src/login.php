<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******login.php****************/
include("includes/functions.php");
if ($_SESSION['logged_in'] == "True")
  {
    header("Location: index.php");
  }
if (isset($_GET['r']))
  {
    incheader("User Login");
    echo "You must be logged in to view this page.<br>\n";
    echo "<form action=\"login.php?mode=login\" method=\"post\">\n";
    echo "<input type=\"hidden\" name=\"login\" value=\"true\">\n";
    echo "<input type=\"hidden\" name=\"redirect\" value=\"".$_GET['r']."\">";
    echo "<b>Username:</b>&nbsp;&nbsp;<input type=\"text\" name=\"uname\"><br>\n";
    echo "<b>Password:</b>&nbsp;&nbsp;<input type=\"password\" name=\"pwd\"><br>\n";
    echo "<input type=\"submit\" value=\"Login\"></form><br>\n";
    echo "<a href=\"sendpwd.php\">Forgot your password?</a><br>\n";
    footer();
  }
if (empty($_GET['mode']))
  {
    incheader("User Login");
    echo "<form action=\"login.php?mode=login\" method=\"post\">\n";
    echo "<input type=\"hidden\" name=\"login\" value=\"true\">\n";
    echo "<b>Username:</b>&nbsp;&nbsp;<input type=\"text\" name=\"uname\"><br>\n";
    echo "<b>Password:</b>&nbsp;&nbsp;<input type=\"password\" name=\"pwd\"><br>\n";
    echo "<input type=\"submit\" value=\"Login\"></form><br>\n";
    echo "<a href=\"sendpwd.php\">Forgot your password?</a><br>\n";
    footer();
  }
if ($_GET['mode'] == "login")
  {
    $Uname = strip_gpc_slashes($_REQUEST['uname']);
    $Pass = md5($_REQUEST['pwd']);
    $sqlpwd = mysql_fetch_array(mysql_query("SELECT UserId, Password, Active, UserLevel, Time_Zone FROM kpfw_users WHERE UserName = '$Uname'"));
    if ($Pass == $sqlpwd['Password'] && $sqlpwd['Active'] == "1")
      {
        $_SESSION['logged_in'] = "True";
        $_SESSION['UserName'] = $Uname;
        $_SESSION['userID'] = $sqlpwd['UserId'];
        $_SESSION['UserLevel'] = $sqlpwd['UserLevel'];
        $_SESSION['TZone'] = $sqlpwd['Time_Zone']*3600;
        $_SESSION['profile'] = preg_replace("/ /", "_",$_SESSION['UserName']);
        $IP_Login = mysql_query("UPDATE kpfw_users SET IP_Login = '".$_SERVER['REMOTE_ADDR']."' WHERE UserId = '".$sqlpwd['UserId']."'");
        if (isset($_REQUEST['redirect']))
          {
            $location = $_REQUEST['redirect'];
            header("Location: $location");
          }
         else
          {
            header("Location: index.php");
          }
      }
    if ($Pass != $sqlpwd['Password'])
      {
        incheader("User Login");
        echo "Username or password is incorect! Please try again.<br>\n";
        echo "<form action=\"login.php?mode=login\" method=\"post\">\n";
        echo "<input type=\"hidden\" name=\"login\" value=\"true\">\n";
        echo "<b>Username:</b>&nbsp;&nbsp;<input type=\"text\" name=\"uname\" value=\"$Uname\"><br>\n";
        echo "<b>Password:</b>&nbsp;&nbsp;<input type=\"password\" name=\"pwd\"><br>\n";
        echo "<input type=\"submit\" value=\"Login\"></form><br>\n";
        echo "<a href=\"sendpwd.php\">Forgot your password?</a><br>\n";
        footer();
      }
    if ($sqlpwd['Active'] == "0")
      {
        incheader("User Login");
        echo "User account is either not yet activated or has been disabled.<br>\n";
        echo "<form action=\"login.php?mode=login\" method=\"post\">\n";
        echo "<input type=\"hidden\" name=\"login\" value=\"true\">\n";
        echo "<b>Username:</b>&nbsp;&nbsp;<input type=\"text\" name=\"uname\" value=\"$Uname\"><br>\n";
        echo "<b>Password:</b>&nbsp;&nbsp;<input type=\"password\" name=\"pwd\"><br>\n";
        echo "<input type=\"submit\" value=\"Login\"></form><br>\n";
        echo "<a href=\"sendpwd.php\">Forgot your password?</a><br>\n";
        footer();
      }
  }
if ($_GET['mode'] == "logout")
  {
    unset($_SESSION);
    session_destroy();
    header("Location: index.php");
  }
?>
