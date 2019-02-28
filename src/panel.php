<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******panel.php**********/
error_reporting(E_ALL^E_NOTICE);
$domain = "http://".$_SERVER['HTTP_HOST'];
if ($domain != "http://www.kpfanworld.com")
  {
    header("302 Moved Permanently");
    header("Location: http://www.kpfanworld.com/panel");
  }
 else
  {
    include("includes/functions.php");
    incheader("KP Panel Information");
    ?>
    <br>
    <table align="center">
      <tr>
        <td><ul><li><b>KP Panel Clip 1</b><br><a href="panel/KP%20Panel%20clip1.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip1.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip1.html" target="_blank">HTML Format</a></li><br><br>
        <li><b>KP Panel Clip 3</b><br><a href="panel/KP%20Panel%20clip3.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip3.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip3.html" target="_blank">HTML Format</a></li><br><br>
        <li><b>KP Panel Clip 5</b><br><a href="panel/KP%20Panel%20clip5.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip5.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip5.html" target="_blank">HTML Format</a></li><br><br>
		<li><b>KP Panel Clip 7</b><br><a href="panel/KP%20Panel%20clip7.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip7.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip7.html" target="_blank">HTML Format</a></li><br><br>
		<li><b>KP Panel Clip 9</b><br><img src="images/pdficon_small.gif" border="0"> PDF Format<br><a href="panel/KP%20Panel%20clip9.mp3" target="_blank">MP3 Format</a><br>HTML Format</li></ul>
        </td>
        <td valign="top">
        <ul><li><b>KP Panel Clip 2</b><br><a href="panel/KP%20Panel%20clip2.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip2.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip2.html" target="_blank">HTML Format</a></li><br><br>
        <li><b>KP Panel Clip 4</b><br><a href="panel/KP%20Panel%20clip4.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip4.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip4.html" target="_blank">HTML Format</a></li><br><br>
		<li><b>KP Panel Clip 6</b><br><a href="panel/KP%20Panel%20clip6.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip6.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip6.html" target="_blank">HTML Format</a></li><br><br>
			<li><b>KP Panel Clip 8</b><br><a href="panel/KP%20Panel%20clip8.pdf" target="_blank"><img src="images/pdficon_small.gif" border="0"> PDF Format</a><br><a href="panel/KP%20Panel%20clip8.mp3" target="_blank">MP3 Format</a><br><a href="panel/KP%20Panel%20clip8.html" target="_blank">HTML Format</a></li></ul>
        </td>
      </tr>
    </table><br>
    <a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank"><img src="images/getacro.gif" border="0"></a>
    <?php
    footer();
  }
?>
