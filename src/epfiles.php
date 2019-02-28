<?php
$table = "kpfw_eps"; // Only change if you intend to use different
session_start();
define('DB_READY',TRUE);
require("includes/db.php");
error_reporting(E_ERROR | E_PARSE);
$install = mysql_fetch_array(mysql_query("SELECT Value FROM ".$table." WHERE ID = 'Installed'"));
$master = mysql_fetch_array(mysql_query("SELECT Value FROM ".$table." WHERE ID = 'MasterPassword'"));
$user = mysql_fetch_array(mysql_query("SELECT Value FROM ".$table." WHERE ID = 'UserPassword'"));
if ($install['Value'] != "True" || $master['Value'] == "" || $user['Value'] == ""){
  $sql = mysql_query("DROP TABLE IF EXISTS ".$table."");
  $sql = mysql_query("CREATE TABLE `".$table."` (
  `ID` VARCHAR( 50 ) NOT NULL ,
  `Value` VARCHAR( 50 ) NOT NULL ,
  INDEX ( `ID` )
  ) ENGINE = MYISAM");
  $sql = mysql_query("INSERT INTO ".$table." VALUES ('MasterPassword', '66b33605078382c9382887968733dffe')");
  $sql = mysql_query("INSERT INTO ".$table." VALUES ('UserPassword', '99149a02c390f116932d032476d25dca')");
  $sql = mysql_query("INSERT INTO ".$table." VALUES ('Installed', 'True')");
  echo "<b><font color=\"#FF0000\">Error Occurred. System Defaults Loaded. System (re)installed.</font></b><br>";
}
if (!$_SESSION['auth'] && !$_GET['mode']){
  ?><br><center><h1>Login</h1><br>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=login" method="post">
  <b>Password:</b> <input type="password" name="pwd"><br>
  <input type="submit" value="Login"></form></center>
  <?php
  exit;
} elseif (($_SESSION['auth'] == "User" || $_SESSION['auth'] == "Admin") && !$_GET['mode']) {
  $user = ($_SESSION['auth'] == "User") ? "User" : "Admin";
  ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=logout">Logout</a> (<?php echo $user; ?> mode)<br>
  <?php
  ($_SESSION['auth'] == "Admin") ? print "<a href=\"".$_SERVER['PHP_SELF']."?mode=admin\">Change Passwords</a><br>" : "";
  ?>
  <center><h1>File List</h1><br><font size="+1" color="#FF0000"><b>We have been forced to implement certain security protocols.<br>Therefore, download managers and public links will be of no use.<br>If anything is attempted other than <i>left</i>-clicking a file link <i>on this page</i>, download <i>will</i> fail.<br><br>Thank You.</b></font><br>
  <?php
  // BEGIN PHP file listing code

  // Code goes here...
  	$dirName = "eps";
	$dp = opendir($dirName);
	//add all files in directory to $theFiles array
	while ($currentFile !== false){
  		$currentFile = readDir($dp);
  		$theFiles[] = $currentFile;
  		sort ($theFiles);
	} // end while
	//extract gif and jpg images
	$imageFiles = preg_grep("/rar$|zip$|avi$|mov$|MOV$|bin$/", $theFiles);
	$output = "";
	$picInRow = 0;
	print "<table border =\"1\">";
	foreach ($imageFiles as $currentFile){
	  if ($picInRow == 0){
           $output .= <<<HERE
<tr>
HERE;
	}//end if
  		$output .= <<<HERE
<td><a href = $dirName/$currentFile>$currentFile</a></td>
HERE;
	$picInRow++;
       if ($picInRow == 5){
           $output .= <<<HERE
</tr>\n
HERE;
           $picInRow = 0;
    	}//end if
	} // end foreach
	print $output;
	print "</table>";
  // END PHP file listing code
  ?></center>
  <?php
  exit; // Leave this line
} elseif ($_GET['mode'] == "admin"){
  if ($_SESSION['auth'] != "Admin"){
    header("Location: ".$_SERVER['PHP_SELF']);
  }
  ?><center><h1>Change Passwords</h1>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=pass" method="post">
  Leave blank to not change.<br>
  <b>Master Password:</b> <input type="password" name="master"><br>
  <b>User Password:</b> <input type="password" name="user"><br>
  <input type="submit" value="Change"></form></center>
  <?php
  exit;
} elseif ($_GET['mode'] == "pass"){
  if ($_SESSION['auth'] != "Admin"){
    header("Location: ".$_SERVER['PHP_SELF']);
  }
  if ($_REQUEST['master']){
    $sql = mysql_query("UPDATE ".$table." SET Value = '".md5($_REQUEST['master'])."' WHERE ID = 'MasterPassword'");
  }
  if ($_REQUEST['user']){
    $sql = mysql_query("UPDATE ".$table." SET Value = '".md5($_REQUEST['user'])."' WHERE ID = 'UserPassword'");
  }
  header("Location: ".$_SERVER['PHP_SELF']);
} elseif ($_GET['mode'] == "login"){
  $master = mysql_fetch_array(mysql_query("SELECT Value FROM ".$table." WHERE ID = 'MasterPassword'"));
  $user = mysql_fetch_array(mysql_query("SELECT Value FROM ".$table." WHERE ID = 'UserPassword'"));
  if (md5($_REQUEST['pwd']) == $master['Value']){
    $_SESSION['auth'] = "Admin";
    header("Location: ".$_SERVER['PHP_SELF']);
  } elseif (md5($_REQUEST['pwd']) == $user['Value']){
    $_SESSION['auth'] = "User";
    header("Location: ".$_SERVER['PHP_SELF']);
  } elseif (md5($_REQUEST['pwd']) != $user['Value'] && md5($_REQUEST['pwd']) != $master['Value']){
    header("Location: ".$_SERVER['PHP_SELF']);
  }
} elseif ($_GET['mode'] == "logout") {
  unset($_SESSION);
  session_destroy();
  header("Location: ".$_SERVER['PHP_SELF']);
}
?>
