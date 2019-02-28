<?php
header("HTTP/1.1 403 Forbidden");
echo "<html>\n<head>\n<meta http-equiv=\"refresh\" content=\"5;url='../index.php'\">\n</head>\n<body>\n";
echo "You are naughty... Shall I report you to the administrators?<br><br>No? Okay I'll just redirect you then.";
echo "\n</body>\n</html>";
?>
