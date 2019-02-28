<?php
include("includes/functions.php");
if (empty($_REQUEST['name']) || empty($_REQUEST['email']) || empty($_REQUEST['feedback']) || empty($_REQUEST['visualconf']))
  {
    echo "<html>\n<head>\n<title>Send a Suggestion</title>\n<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n</head>\n<body>\n<h1>Send in Feedback</h1>\n<script type=\"text/javascript\" src=\"includes/rclick.js\"></script>\n";
    echo "<center><br>All fields are required!<br><br><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back\">\n";
    echo "<br></center>\n</body>\n</html>";
  }
 else
  {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $feedback = $_REQUEST['feedback'];
    $visual = md5($_REQUEST['visualconf']);
    if (valid_email($email))
      {
        if ($visual == $_SESSION['visual_confirmation'])
          {
            mail("staff@kpfanworld.com","Feedback from KP Fan World",strip_gpc_slashes("Dear Staff,\n\n$name ($email) has provided feedback using the KP Fan World feedback page. Their message is as follows:\n\n$feedback\n\n--------\nThank you.\n\nIP: ".$_SERVER['REMOTE_ADDR'].""),$_SESSION['headers']);
            mail($email,"Feedback Received: KP Fan World",strip_gpc_slashes("Dear $name,\n\nThe following message has been receieved by the staff of KP Fan World:\n\n$feedback\n-------\nThank you.\n\nIP: ".$_SERVER['REMOTE_ADDR'].""),$_SESSION['headers']);
            header("Location: suggest.html");
          }
         else
          {
            echo "<html>\n<head>\n<title>Send a Suggestion</title>\n<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n</head>\n<body>\n<h1>Send in Feedback</h1>\n<script type=\"text/javascript\" src=\"includes/rclick.js\"></script>\n";
            echo "<center><br>Code incorrect! Please try again.<br><br><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back\">\n<br><br>If you continue to have problems, you may email us at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>\n";
            echo "<br></center>\n</body>\n</html>";
          }
      }
     else
      {
        echo "<html>\n<head>\n<title>Send a Suggestion</title>\n<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/kpfw.css\">\n</head>\n<body>\n<h1>Send in Feedback</h1>\n<script type=\"text/javascript\" src=\"includes/rclick.js\"></script>\n";
        echo "<center><br>Email invalid! Please try again.<br><br><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back\">\n<br><br>If you continue to have problems, you may email us at <a href=\"mailto:staff@kpfanworld.com\">staff@kpfanworld.com</a>\n";
        echo "<br></center>\n</body>\n</html>";
      }
  }
?>
