<center><br><span class="text">Mouseover to view spoilers.<br>The yellow lines are underneath each item to give visibility to the user.<br><br><br>"Confirmed" spoilers have been verified with the KP Crew (Bob Schooley, Mark McCorkle, or Steve Loter) by a staff member.<br>If you have any questions, please email us at <a href="mailto:staff@kpfanworld.com">staff@kpfanworld.com</a>.</span><br><br><br>
<table>
  <tr>
    <th align="center">Plot -- Confirmed</th>
  </tr>
  <tr><td height="10" class="spoiler"></td></tr>
  <tr>
    <td class="spoiler"><ul><?
      $spoiler = mysql_query("SELECT * FROM kpfw_spoiler WHERE Confirmed = 'True' AND Classification = 'Plot'");
      while($plot = mysql_fetch_array($spoiler))
        {
          echo "<li class=\"spoiler\" onmouseover=\"this.style.color='#FFFFFF';return true\" onmouseout=\"this.style.color='#000000';return true\">";
          echo strip_gpc_slashes($plot['SpoilerText']);
          echo "</li>";
        }?>
      </ul>
    </td>
  </tr><tr><td height="30" class="spoiler">&nbsp;</td></tr>
  <tr>
    <th align="center">Episode Title/Description -- Confirmed</th>
  </tr>
  <tr><td height="10" class="spoiler"></td></tr>
  <tr>
    <td class="spoiler"><ul><?
      $spoiler = mysql_query("SELECT * FROM kpfw_spoiler WHERE Confirmed = 'True' AND Classification = 'Episode'");
      while($plot = mysql_fetch_array($spoiler))
        {
          echo "<li class=\"spoiler\" onmouseover=\"this.style.color='#FFFFFF';return true\" onmouseout=\"this.style.color='#000000';return true\">";
          echo strip_gpc_slashes($plot['SpoilerText']);
          echo "</li>";
        }?>
      </ul>
    </td>
  </tr><tr><td height="30" class="spoiler">&nbsp;</td></tr>
  <tr>
    <th align="center">Miscellaneous -- Confirmed</th>
  </tr>
  <tr><td height="10" class="spoiler"></td></tr>
  <tr>
    <td class="spoiler"><ul><?
      $spoiler = mysql_query("SELECT * FROM kpfw_spoiler WHERE Confirmed = 'True' AND Classification = 'Miscellaneous'");
      while($plot = mysql_fetch_array($spoiler))
        {
          echo "<li class=\"spoiler\" onmouseover=\"this.style.color='#FFFFFF';return true\" onmouseout=\"this.style.color='#000000';return true\">";
          echo strip_gpc_slashes($plot['SpoilerText']);
          echo "</li>";
        }?>
      </ul>
    </td>
  </tr><tr><td height="60" class="spoiler">&nbsp;</td></tr>
  <tr>
    <th align="center">Plot</th>
  </tr>
  <tr><td height="10" class="spoiler"></td></tr>
  <tr>
    <td class="spoiler"><ul><?
      $spoiler = mysql_query("SELECT * FROM kpfw_spoiler WHERE Confirmed = 'False' AND Classification = 'Plot'");
      while($plot = mysql_fetch_array($spoiler))
        {
          echo "<li class=\"spoiler\" onmouseover=\"this.style.color='#FFFFFF';return true\" onmouseout=\"this.style.color='#000000';return true\">";
          echo strip_gpc_slashes($plot['SpoilerText']);
          echo "</li>";
        }?>
      </ul>
    </td>
  </tr><tr><td height="30" class="spoiler">&nbsp;</td></tr>
  <tr>
    <th align="center">Episode Title/Description</th>
  </tr>
  <tr><td height="10" class="spoiler"></td></tr>
  <tr>
    <td class="spoiler"><ul><?
      $spoiler = mysql_query("SELECT * FROM kpfw_spoiler WHERE Confirmed = 'False' AND Classification = 'Episode'");
      while($plot = mysql_fetch_array($spoiler))
        {
          echo "<li class=\"spoiler\" onmouseover=\"this.style.color='#FFFFFF';return true\" onmouseout=\"this.style.color='#000000';return true\">";
          echo strip_gpc_slashes($plot['SpoilerText']);
          echo "</li>";
        }?>
      </ul>
    </td>
  </tr><tr><td height="30" class="spoiler">&nbsp;</td></tr>
  <tr>
    <th align="center">Miscellaneous</th>
  </tr>
  <tr><td height="10" class="spoiler"></td></tr>
  <tr>
    <td class="spoiler"><ul><?
      $spoiler = mysql_query("SELECT * FROM kpfw_spoiler WHERE Confirmed = 'False' AND Classification = 'Miscellaneous'");
      while($plot = mysql_fetch_array($spoiler))
        {
          echo "<li class=\"spoiler\" onmouseover=\"this.style.color='#FFFFFF';return true\" onmouseout=\"this.style.color='#000000';return true\">";
          echo strip_gpc_slashes($plot['SpoilerText']);
          echo "</li>";
        }?>
      </ul>
    </td>
  </tr><tr><td height="30" class="spoiler">&nbsp;</td></tr>
  <?php
  if ($_SESSION['logged_in'])
   {
   ?>
  <tr>
    <td class="link"><a href="spoilers?confirm=true&mode=submit">Submit Spoilers</a></td>
  </tr>
  <?php
   }
  ?>
</table>
</center>
