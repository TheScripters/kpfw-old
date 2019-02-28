<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******register.php*************/

// Begin session
session_start();
// Include functions
include("includes/functions.php");
// If the user is NOT logged in
if (!isset($_SESSION['logged_in']))
  {
    // If 'mode' NOT empty
    if (!empty($_REQUEST['mode']))
      {
        // Set variables with submitted values
        $UserName = $_REQUEST['UserName'];
        $UEmail = $_REQUEST['Email'];
        $UEmail2 = $_REQUEST['email_conf'];
        $Pass = $_REQUEST['Password'];
        $Pass1 = $_REQUEST['pwd_conf'];
        $Code_Confirm = md5($_REQUEST['code_confirm']);
        $ShowEmail = $_REQUEST['ShowEmail'];
        $Name = $_REQUEST['Name'];
        $Act_Key = randomkeys(10);
        
        // Make sure all required fields are filled in and that passwords match
        if ($Pass == $Pass1 && !empty($UserName) && !empty($UEmail) && !empty($UEmail2) && $UEmail == $UEmail2 && $Code_Confirm == $_SESSION['visual_confirmation'])
          {
            if (!valid_email($UEmail))
              {
                incheader("User Registration");
                echo "<br><center>Email address invalid!</center>";
                registration_form();
                footer();
              }
            if (!valid_email($UEmail2))
              {
                incheader("User Registration");
                echo "<br><center>Email address invalid!</center>";
                registration_form();
                footer();
              }
            if (!validuser($UserName))
              {
                incheader("User Registration");
                echo "<br><center>Username invalid. Please do not include punctuation.</center>";
                registration_form();
                footer();
              }
            $sql_user = mysql_query("SELECT COUNT(*) AS count FROM kpfw_users WHERE UserName = '".$UserName."'");
            $User = mysql_fetch_array($sql_user);
            $sql_email = mysql_query("SELECT COUNT(*) AS count FROM kpfw_users WHERE UserEmail = '".$UEmail."'");
            $UserEmail = mysql_fetch_array($sql_email);
            if ($User['count'] == "1" || $UserEmail['count'] == "1")
              {
                if ($User['count'] == "1")
                  {
                    incheader("User Registration");
                    echo "<br><center>Username already in use!</center>";
                    registration_form();
                    footer();
                  }
                if ($UserEmail['count'] >= "1")
                  {
                    incheader("User Registration");
                    echo "<br><center>Email already in use!</center>";
                    registration_form();
                    footer();
                  }
              }
             else
              {
                if ($ShowEmail != "True"){$Show_Email = "No";}
                if ($ShowEmail == "True"){$Show_Email = "Yes";}
                if ($_REQUEST['AvatarHost'] == "True"){mkdir("/home/kpfanwor/public_html/hosting/".$UserName);}
                $md5pwd = md5($Pass);
                $joined = time();
                //if (empty($Name)){$Name = "NULL";}
                $sql_reg = mysql_query("INSERT INTO kpfw_users VALUES (NULL , '".$UserName."', '".$UEmail."', MD5( '".$Pass."' ) , '$joined', '', '', '".$Show_Email."', '$Name', '', '$Act_Key', '0', '1', '0')");
                $userID = mysql_fetch_array(mysql_query("SELECT UserID FROM kpfw_users WHERE UserEmail = '$UEmail'"));
                $insert_ID = mysql_insert_id();
                //$headers = "Reply-to: staff@kpfanworld.com\nFrom: staff@kpfanworld.com\nReturn-Path: staff@kpfanworld.com\nMessage-ID: <" . md5(time()) . "@kpfanworld.com>\nMIME-Version: 1.0\nContent-type: text/plain; charset=iso-8859-1\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By KPFanWorld.com\n";
                mail("$UserName <$UEmail>", "User Activation At KPFanWorld.com", strip_gpc_slashes("Hello $UserName,\n\nWe are happy you have decided to register at Kim Possible Fanworld. However, your account remains inactive to cut down on SPAM.\n\nUse the following URL to activate your account:\nhttp://www.kpfanworld.com/activate.php?user=".$userID['UserID']."&code=$Act_Key\nIf you are experiencing issues activating your account please contact Staff@kpfanworld.com\n\nYour username and password are shown below:\n\n------------------------\nUsername: $UserName\nPassword: $Pass\n-------------------------\n\nYour password is encoded and irretrievable. If you lose your password, you may request a new one at any time.\n\nYour profile can be accessed at any of the following URLs:\nhttp://www.kpfanworld.com/profile/".preg_replace("/ /","_",$UserName)."\nhttp://www.kpfanworld.com/profile/".$userID['UserID']."\nhttp://www.kpfanworld.com/profile.php?user=".$userID['UserID']."\n\nThank you.\nKim Possible Fan World Management"), $_SESSION['headers']);
              }
            header("Location: index.php");
          }
         else
          {
            if (empty($UserName))
              {
                incheader("User Registration");
                echo "Username must be filled in!";
                registration_form();
                footer();
              }
            if (empty($UEmail))
              {
                incheader("User Registration");
                echo "Email address must be filled in!";
                registration_form();
                footer();
              }
            if (empty($UEmail2))
              {
                incheader("User Registration");
                echo "Email address confirmation must be filled in!";
                registration_form();
                footer();
              }
            if ($Pass != $Pass1)
              {
                incheader("User Registration");
                echo "Passwords do not match!";
                registration_form();
                footer();
              }
            if ($UEmail != $UEmail2)
              {
                incheader("User Registration");
                echo "E-mail addresses do not match!";
                registration_form();
                footer();
              }
            if ($Code_Confirm != $_SESSION['visual_confirmation'])
              {
                incheader("User Registration");
                echo "Confirmation Code Invalid";
                registration_form();
                footer();
              }
          }
        
      }
     else
      {
        incheader("User Registration");
        registration_form();
        footer();
      }
    
  }
if (isset($_SESSION['logged_in']))
  {
    incheader("User Registration");
    echo "<center>Username already exists!<br>Click <a href=\"index.php\">here</a> to return.</center>";
    footer();
  }
?>
