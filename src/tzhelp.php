<?php
if (!$_GET['mode']) {
  ?><html>
<head>
<link rel="stylesheet" type="text/css" href="includes/kpfw.css">
<title>TimeZone Help</title>
</head>

<body>
<h1>Time Zone Helper</h1>
<center>Current Server time:<br><b><?=date("d M Y h:i A T e")?></b><br><br>
Current GMT Time:<br><b><?=gmdate("d M Y h:i A")?></b></center><br><br>
<h2>Still need help?</h2>
<center><form action="tzhelp.php?mode=time" method="post">
Enter your current time in 24-hour time (in HH:MM format) in the box below.<br>Example for those confused: If it's 6 PM right now, you would enter 18:00. For 6:30 PM, it'd be 18:30.<br>
<input type="text" size="6" name="time"><br><br>To be most accurate, please select your current date:<br>
<select name="date"><option value="<?=date("d m Y",time()-86400)?>" name="date"><?=date("d M Y",time()-86400)?></option>
<option value="<?=date("d m Y")?>" SELECTED name="date"><?=date("d M Y")?></option>
<option value="<?=date("d m Y",time()+86400)?>" name="date"><?=date("d M Y",time()+86400)?></option></select><br><br>
<input type="submit" value="Check Time Zone"></form></center>

</body>
</html>
  <?php
} elseif ($_GET['mode'] == "time"){
  $server = time()-(date("Z"));
  $time = explode(":",$_REQUEST['time']);
  $date = explode(" ",$_REQUEST['date']);
  $newtime = (mktime($time[0],$time[1],0,$date[1],$date[0],$date[2]) - $server) / 3600;
  $offset = number_format($newtime,2,'.',',');
  $offset_exp = explode(".",$offset);
  if ($offset_exp[1] >= 70 && $offset < 0){
    $offset_round = ceil($offset);
  } elseif ($offset_exp[1] >= 70 && $offset > 0){
    $offset_round = floor($offset);
  } elseif ($offset_exp[1] <= 30 && $offset < 0) {
    $offset_round = ceil($offset);
  } elseif ($offset_exp[1] <= 30 && $offset > 0) {
    $offset_round = floor($offset);
  } elseif ($offset_exp[1] <= 69 && $offset_exp >= 31) {
    $offset_round = $offset_exp[0].".5";
  }
  ?><html>
<head>
<link rel="stylesheet" type="text/css" href="includes/kpfw.css">
<title>TimeZone Help</title>
</head>

<body>
<h1>Time Zone Helper</h1>
<center>Current Server time:<br><b><?=date("d M Y h:i A T e")?></b><br><br>
Current GMT Time:<br><b><?=gmdate("d M Y h:i A")?></b></center><br><br>
<h2>Check Results</h2>
<center>Because of how the time offset is calculated, the following results may not be 100% accurate.They will be close, however.<br><br>
Say your offset from GMT is -3.5 hours. This calculation may show -3.6 or -3.4 because of differences in computer times. If your offset is +5, it may show 5.1 or 4.9. You will need to round to the nearest half hour.<br><br>Your offset is: <b><?=$offset_round?></b></center><br>
</body>
</html>
  <?php
}
?>
