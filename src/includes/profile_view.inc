<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******profile_view.inc*********/
$profilename = (!$ProfileV['Name']) ? "None" : $ProfileV['Name'];
?><br>
<table width="75%" rules="none" align="center" border="1">
  <tr>
    <th>View Profile</th>
  </tr>
  <tr>
    <td align="center">
    <table align="center">
      <tr>
        <td valign="top"><b>Username:</b>&nbsp;&nbsp;<i><?=$ProfileV['UserName']?></i><br>
        <?php
        ($ProfileV['ShowEmail'] == "Yes") ? print "<b>Email Address:</b>&nbsp;&nbsp;<a href=\"mailto:".$ProfileV['UserEmail']."\">".$ProfileV['UserEmail']."</a><br>\n" : "";
        ?>
        </td><td valign="top">
        <b>Member Since:</b>&nbsp;&nbsp;<i><?=gmdate("D, d M Y g:i A",$ProfileV['Joined_Date']+$_SESSION['TZone'])?></i><br>
        <b>Name:</b>&nbsp;&nbsp;<i><?=$profilename?></i><br>
        </td>
      </tr>
      <tr>
        <td colspan="2"><?=stripslashes(nl2br(bbcode($ProfileV['Profile'])))?></td>
      </tr>
    </table>
    </td>
  </tr>
</table><br>
