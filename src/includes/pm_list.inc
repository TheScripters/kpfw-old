<!-- includes/pm_list.inc -->
      <tr>
        <td align="center" width="30"><!--<img src="images/pm<?echo$new?>.jpg">--></td>
        <td align="center" width="30%"><a href="privmsg.php?id=<?echo$PMInfo["MsgID"]?>"><?echo$PMInfo['Subject']?></a></td>
        <td align="center" width="20%"><?echo$From['UserName']?></td>
        <td align="center"><?echo gmdate("D, d M Y g:i A",$PMInfo['Sent']+$_SESSION['TZone'])?></td>
      </tr>
