<?php
   include ("includes/functions.php");
  incheader("Video Hosting");
  print "<br><a href=\"media/video\">Back</a><br>
  <embed src=\"video/stripslashes(".$_GET['vid'].")\" autostart=\"true\"><br>";
  footer();
?>