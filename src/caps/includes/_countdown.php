<?php
//function written by Adam Humpherys
//barrowed from KPFW
function countdown($hour, $minute, $second, $month, $day, $year)
  {
    $now = time();
    $date = mktime($hour,$minute,$second,$month,$day,$year);
    $secleft = $date-$now;
    $dayleft = floor($secleft/86400);
    $dayhr = $secleft-($dayleft*86400);
    $hrleft = floor($dayhr/3600);
    $hrmin = $secleft-(($dayleft*86400)+($hrleft*3600));
    $minleft = floor($hrmin/60);
    $secsleft = $secleft-(($dayleft*86400)+($hrleft*3600)+($minleft*60));
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
    }elseif ($dayleft >= 1 && $hrleft == 0 && $minleft == 0 && $secsleft == 0){
      $timeleft = $dayleft.$day;
    }
    if ($hrleft >= 1 && ($minleft >= 1 || $secsleft >= 1)){
      $timeleft .= $hrleft.$hour.", ";
    }elseif ($hrleft >= 1 && $minleft == 0 && $secsleft == 0){
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
    return $timeleft;
  }
?>