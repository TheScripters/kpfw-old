<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******privmsg_text.php*********/
$sql = mysql_query("UPDATE kpfw_privmsg SET New = '0' WHERE MsgID = '".$_GET['id']."'");
?>
<table width="75%" border="1" rules="none" align="center">
  <tr>
    <th class="privmsg">View Private Message</th>
  </tr>
  <tr>
    <td align="center">
      <table width="100%">
        <tr>
          <td width="50%"><b>Sender:</b>&nbsp;&nbsp;<i><?echo$PMFrom['UserName']?></i><br>
          <b>Recipient:</b>&nbsp;&nbsp;<i><?echo$_SESSION['UserName']?></i><br>
          <b>Date:</b>&nbsp;&nbsp;</i><?echo gmdate("D, d M Y g:i A", $PMInfo['Sent']+$_SESSION['TZone'])?><br>
          <b>Subject:</b>&nbsp;&nbsp;<i><?echo$PMInfo['Subject']?></i></td>
          <td width="50%" align="right" valign="bottom"><a href="pmaction.php?id=<?echo$_GET['id']?>&mode=reply"><img src="images/pm_reply.jpg" border="0"></a>&nbsp;&nbsp;<a href="pmaction.php?id=<?echo$_GET['id']?>&mode=delete"><img src="images/pm_delete.jpg" border="0"></a>&nbsp;&nbsp;<a href="pmaction.php?id=<?echo$_GET['id']?>&mode=forward"><img src="images/pm_forward.jpg" border="0"></a></td>
        </tr>
        <tr>
          <td colspan="2"><hr size="2" color="lime"><br><?echo$MsgText?></td>
        </tr>
      </table>
    </td>
  </tr>
  <!--<tr>
    <th class="privmsg"><form action="pmaction.php" method="post"><input type="hidden" value="<?//echo$pmID?>" name="pmID"><select name="action"><option name="action" value="reply">Reply</option><option name="action" value="delete">Delete</option></select><input type="submit" value="Submit"></form></th>
  </tr>-->
</table>
