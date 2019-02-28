<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys and Brian Wallace
/*******downloads.php************/
include("includes/functions.php");
incheader("Downloads");

if (isset($_GET['page']))
  {
    if (file_exists("downloads/".$_GET['page'].".inc"))
      {
        include("downloads/".$_GET['page'].".inc");
      }
     else
      {
        include("includes/download_error.inc");
      }
  }
 else
  {
    include("includes/download-index.inc");
  }  
footer();

?>