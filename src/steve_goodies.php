<?php
// Code © 2006 KPFanWorld.com
// Code written by brian wallace
/*******donate.php***************/
include("includes/functions.php");
incheader("Donate");
print "<br><br><center>Sorry the fundraiser has been canceled. </center>";
/*print "<br><br><center>
Ladies and Gentlemen, this is an opportunity for us to help Kimmie actually help save some childs' world, Gang. Any donations made here will be donated to Childrens' Hospital.<br>As her show fades to reruns and we all remember her fondly, give as generously as you can to save the world one more time in Kim Possibles' name. We, together, can make a difference.<br>Grandpa Rd, and the whole staff of RS.Net thanks you. Make a child Smile today the KP way. Just one more time...<br><br>"; 

print "If you do wish to donate, clcik the button below<br>
<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">
<input type=\"image\" src=\"https://www.paypal.com/en_US/i/btn/x-click-but21.gif\" border=\"0\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\">
<img alt=\"\" border=\"0\" src=\"https://www.paypal.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">
<input type=\"hidden\" name=\"encrypted\" value=\"-----BEGIN PKCS7-----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-----END PKCS7-----\">
</form>The current donated balance is \$652.94 USD<br><br>Those who donate can use these banners to show everyone you donated.<br>
<table border=\"0\">
<tr>
	<td align=\"center\">
		<img src=\"http://www.kpfanworld.com/images/steve_goodies/finisheddh5.gif\" alt=\"finisheddh5.gif\"><br><input type=\"text\" readonly size=\"40\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/steve_goodies.php][img]http://www.kpfanworld.com/images/steve_goodies/finisheddh5.gif[/img][/url]\">
	</td>
	<td align=\"center\">
		<img src=\"http://www.kpfanworld.com/images/steve_goodies/finishedgl6.gif\" alt=\"finishedgl6.gif\"><br><input type=\"text\" readonly size=\"40\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/steve_goodies.php][img]http://www.kpfanworld.com/images/steve_goodies/finishedgl6.gif[/img][/url]\">
	</td>
</tr>
<tr>
	<td align=\"center\">
		<img src=\"http://www.kpfanworld.com/images/steve_goodies/finishedxp4.gif\" alt=\"finishedxp4.gif\"><br><input type=\"text\" readonly size=\"40\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/steve_goodies.php][img]http://www.kpfanworld.com/images/steve_goodies/finishedxp4.gif[/img][/url]\">
	</td>
	<td align=\"center\">
		<img src=\"http://www.kpfanworld.com/images/steve_goodies/finishedxq3.gif\" alt=\"finishedxq3.gif\"><br><input type=\"text\" readonly size=\"40\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/steve_goodies.php][img]http://www.kpfanworld.com/images/steve_goodies/finishedxq3.gif[/img][/url]\">
	</td>
</tr>
<tr>
	<td align=\"center\">
		<img src=\"http://www.kpfanworld.com/images/steve_goodies/finishedye8.gif\" alt=\"finishedye8.gif\"><br><input type=\"text\" readonly size=\"40\" onfocus=\"javascript:this.select()\" value=\"[url=http://www.kpfanworld.com/steve_goodies.php][img]http://www.kpfanworld.com/images/steve_goodies/finishedye8.gif[/img][/url]\">
	</td>
	<td align=\"center\"></td>
</tr>
</table></center>";*/
footer();
?>
