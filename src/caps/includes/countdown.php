<?php
function countdown($hour,$minute,$second,$month,$day,$year,$sens,$left,$exp,$len,$expire)
  {
    /***** Countdown function v 1.2 ***************
     ***** Written by Adam Humpherys **************
     ***** © 2006 Adam Humpherys ******************
     ***** http://www.adamh.us/projects/personal **
     ***** Usage:
     countdown([int hour,[int minute, [int second, [int month, [int day, [int year, [str sens, [str left, [str exp, [int len, [str exp]]]]]]]]]]]) **********/
    if (!$month || !$day || !$year || !$sens || !$left || !$exp || !$len || !$expire){
      $month = (!$month) ? 1 : "";
      $day = (!$day) ? 1 : "";
      $year = (!$year) ? 2007 : "";
      $sens = (!$sens) ? "sec" : "";
      $left = (!$left) ? "Estimated: %time%" : "%time%";
      $exp = (!$exp) ? "It's here!" : "";
      $len = (!$len) ? -86400 : "";
      $expire = (!$expire) ? "<b>Time Expired!</b>" : "";
    }
    $now = time();
    $date = mktime($hour,$minute,$second,$month,$day,$year);
    $secleft = $date-$now;
    if ($secleft >= 1){
      $dayleft = floor($secleft/86400);
      if ($sens == "hr" || $sens == "min" || $sens == "sec"){
        $dayhr = $secleft-($dayleft*86400);
        $hrleft = floor($dayhr/3600);
      }
      if ($sens == "min" || $sens == "sec"){
        $hrmin = $secleft-(($dayleft*86400)+($hrleft*3600));
        $minleft = floor($hrmin/60);
      }
      if ($sens == "sec"){
        $secsleft = $secleft-(($dayleft*86400)+($hrleft*3600)+($minleft*60));
      }
      if ($dayleft >= 2){
        $day = " days";
      } elseif ($dayleft == 1){
        $day = " day";
      }
      if ($hrleft >= 2){
        $hour = " hours";
      } elseif ($hrleft == 1){
        $hour = " hour";
      }
      if ($minleft >= 2){
        $minute = " minutes";
      } elseif ($minleft == 1){
        $minute = " minute";
      }
      if ($secsleft >= 2){
        $second = " seconds";
      } elseif ($secsleft == 1){
        $second = " second";
      }
      if ($dayleft >= 1 && ($hrleft >= 1 || $minleft >= 1 || $secsleft >= 1)){
        $timeleft = $dayleft.$day.", ";
      } elseif ($dayleft >= 1 && $hrleft == 0 && $minleft == 0 && $secsleft == 0){
        $timeleft = $dayleft.$day;
      }
      if ($hrleft >= 1 && ($minleft >= 1 || $secsleft >= 1)){
        $timeleft .= $hrleft.$hour.", ";
      } elseif ($hrleft >= 1 && $minleft == 0 && $secsleft == 0){
        $timeleft .= $hrleft.$hour;
      }
      if ($minleft >= 1 && $secsleft >= 1){
        $timeleft .= $minleft.$minute.", ";
      } elseif ($minleft >= 1 && $secsleft == 0){
        $timeleft .= $minleft.$minute;
      }
      if ($secsleft >= 1){
        $timeleft .= $secsleft.$second;
      }
      $time = $left;
      $timeleft = str_replace("%time%",$timeleft,$time);
    } elseif ($secleft <= 0 && $secleft >= $len){
      $timeleft = $exp;
    } elseif ($secleft <= 0 && $secleft < $len){
      $timeleft = $expire;
    }
    return $timeleft;
  }
?>
