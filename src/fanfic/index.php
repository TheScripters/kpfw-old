<?php
include "includes/functions.php";
incheader("Home");
$story = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpfw_fftitles"));
$story_s = ($story['cnt'] == 1) ? "story" : "stories";
$chap = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS cnt FROM kpfw_ffchapter"));
?><br>
<font size="+2" color="#00FF00"><b>Registrations on KPFanFiction.com are working once again!<br>Thank you for your patience in this matter.</b></font><br><br>
There are currently <b><?=$story['cnt']?></b> <?=$story_s?> and <b><?=$chap['cnt']?></b> chapters online from the old KPFanFiction.com database.<br><br>

If you can plese be patient with us, we can try to get more online.<br>If you have not yet been contacted about your account on KPFanFiction.com, we apologize and you are free to contact us at 

<script language="javascript" type="text/javascript">
		function m_sfcon_1 (u) {
		pre = "mail";
		url = pre + "to:" + u;
		document.location.href = url + "@kpfanworld.com";
	}
	</script>
	<a href="javascript:m_sfcon_1('fanfic')">fanfic contact</a>
if you wish to find out the status of your stories.<br>If you can't remember what your username was or if you'd like to see what you had online, you can go <a href="http://kpff.thescripters.net" target="_blank">here</a> to find out.<br><br>

We are in the process of updating the source code and redoing much of the site, so please bear with us while we work out the details.<br><br>

If you would be interested in helping with moderation, feel free to let us know at 
<script language="javascript" type="text/javascript">
		function m_sfcon_2 (u) {
		pre = "mail";
		url = pre + "to:" + u;
		document.location.href = url + "@kpfanworld.com";
	}
	</script>
	<a href="javascript:m_sfcon_2('fanfic')">fanfic contact</a> and tell us how much you'd like to do. We'll set you up with the appropriate privledges.<br><br><br><br>

<?php
footer();
?>
