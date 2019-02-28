<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******privmsg_send.php*********/
?>
<table width="75%" border="1" rules="none" align="center">
  <tr>
    <th class="privmsg">Send Private Message</th>
  </tr>
  <tr>
    <td align="center">
      <table width="100%">
        <tr><form action="pmaction.php?mode=send" method="post">
        <input type="hidden" name="send" value="send">
          <td><b>To:</b>&nbsp;&nbsp;<input type="text" name="rptName"><br>
          <b>Subject:</b>&nbsp;&nbsp;<input type="text" name="Subject"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><hr size="2" color="lime"><br>
          <textarea rows="10" cols="70" name="MsgText"></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center"><input type="submit" value="Send Message">&nbsp;&nbsp;
    <input type="button" value="Cancel" onclick="history.go(-1)"></form></td>
  </tr>
</table>
