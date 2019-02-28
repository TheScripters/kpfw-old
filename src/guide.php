<?php
// Code © KPFanWorld.com
// Code written by Adam Humpherys
/*******guide.php****************/
include("includes/functions.php");
if ($_GET['mode'] == "add"){
  if ($_GET['type'] == 'stars'){
    $ep = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
    if ($_REQUEST['stars'] == "regular"){
      $cast = mysql_fetch_array(mysql_query("SELECT Stars FROM kpfw_epguide WHERE EpId = '".$_REQUEST['ep']."'"));
      if (!$cast['Stars']){
        $sql = mysql_query("UPDATE kpfw_epguide SET Stars = '".clean_it($_REQUEST['newcast'])."' WHERE EpId = '".$_REQUEST['ep']."'");
        mail_admin("Ep Guide>".$ep['EpTitle'].">Stars",$cast['Stars'],clean_it($_REQUEST['newcast']));
      } else {
        $sql = mysql_query("UPDATE kpfw_epguide SET Stars = '".$cast['Stars'].", ".clean_it($_REQUEST['newcast'])."' WHERE EpId = '".$_REQUEST['ep']."'");
        mail_admin("Ep Guide>".$ep['EpTitle'].">Stars",$cast['Stars'],$cast['Stars'].", ".$_REQUEST['newcast']);
      }
      header("Location: guides/".$_REQUEST['ep']);
    }
    elseif ($_REQUEST['stars'] == "guest"){
      $cast = mysql_fetch_array(mysql_query("SELECT GuestStars FROM kpfw_epguide WHERE EpId = '".$_REQUEST['ep']."'"));
      if (!$cast['GuestStars']){
        $sql = mysql_query("UPDATE kpfw_epguide SET GuestStars = '".clean_it($_REQUEST['newcast'])."' WHERE EpId = '".$_REQUEST['ep']."'");
        mail_admin("Ep Guide>".$ep['EpTitle'].">Guest Stars",$cast['GuestStars'],clean_it($_REQUEST['newcast']));
      } else {
        $sql = mysql_query("UPDATE kpfw_epguide SET GuestStars = '".$cast['GuestStars'].", ".clean_it($_REQUEST['newcast'])."' WHERE EpId = '".$_REQUEST['ep']."'");
        mail_admin("Ep Guide>".$ep['EpTitle'].">Guest Stars",$cast['GuestStars'],$cast['GuestStars'].", ".clean_it($_REQUEST['newcast']));
      }
      header("Location: guides/".$_REQUEST['ep']);
    }
  } elseif ($_GET['type'] == "notes"){
   $sql = mysql_query("INSERT INTO kpfw_epnotes VALUES (NULL, '".$_REQUEST['ep']."', '".clean_it($_REQUEST['note'])."', '".$_SESSION['userID']."')");
   $ep = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
   mail_admin("Notes>".$ep['EpTitle'],0,clean_it($_REQUEST['note']));
   header("Location: guides/".$_REQUEST['ep']);
 } elseif ($_GET['type'] == "quotes"){
   $sql = mysql_query("INSERT INTO kpfw_quotes VALUES (NULL, '".$_REQUEST['ep']."', '".clean_it($_REQUEST['quote'])."', '".$_SESSION['userID']."')");
   $ep = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
   mail_admin("Quotes>".$ep['EpTitle'],0,clean_it($_REQUEST['quote']));
   header("Location: guides/".$_REQUEST['ep']);
 } elseif ($_GET['type'] == "goofs"){
   $sql = mysql_query("INSERT INTO kpfw_goofs VALUES (NULL, '".$_REQUEST['ep']."', '".clean_it($_REQUEST['goof'])."', '".$_SESSION['userID']."')");
   $ep = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
   mail_admin("Goofs>".$ep['EpTitle'],0,clean_it($_REQUEST['goof']));
   header("Location: guides/".$_REQUEST['ep']);
 } elseif ($_GET['type'] == "cultural"){
   $sql = mysql_query("INSERT INTO kpfw_cultural VALUES (NULL, '".$_REQUEST['ep']."', '".addslashes(clean_it($_REQUEST['cultural']))."', '".$_SESSION['userID']."')");
   $ep = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
   mail_admin("Cultural Ref>".$ep['EpTitle'],0,clean_it($_REQUEST['cultural']));
   header("Location: guides/".$_REQUEST['ep']);
 } elseif ($_GET['type'] == "dvdnote"){
   $sql = mysql_query("INSERT INTO kpfw_dvdnotes VALUES (NULL, '".$_REQUEST['dvd']."', '".clean_it($_REQUEST['note'])."', '".$_SESSION['userID']."')");
   $ep = mysql_fetch_array(mysql_query("SELECT Title FROM kpfw_dvdmovie WHERE Id = '".$_REQUEST['dvd']."'"));
   mail_admin("DVD Guides>".$ep['Title'],0,clean_it($_REQUEST['note']));
   header("Location: movie/".$_REQUEST['dvd']);
 }
} elseif ($_GET['mode'] == "edit"){
  if ($_REQUEST['type'] == "stars"){
    incheader("Edit Stars");
    $stars = mysql_fetch_array(mysql_query("SELECT Stars FROM kpfw_epguide WHERE EpId = '".$_REQUEST['ep']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<input type=\"text\" size=\"35\" name=\"stars\" value=\"".$stars['Stars']."\"><br>\n";
    echo "<input type=\"hidden\" name=\"ep\" value=\"".$_REQUEST['ep']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"stars\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  } elseif ($_REQUEST['type'] == "guests"){
    incheader("Edit Guest Stars");
    $guests = mysql_fetch_array(mysql_query("SELECT GuestStars FROM kpfw_epguide WHERE EpId = '".$_REQUEST['ep']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<input type=\"text\" size=\"35\" name=\"guests\" value=\"".$guests['GuestStars']."\"><br>\n";
    echo "<input type=\"hidden\" name=\"ep\" value=\"".$_REQUEST['ep']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"guests\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  } elseif ($_REQUEST['type'] == "note"){
    incheader("Edit Notes");
    $note = mysql_fetch_array(mysql_query("SELECT NoteText FROM kpfw_epnotes WHERE NoteId = '".$_REQUEST['note']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<textarea rows=\"5\" cols=\"50\" name=\"notetext\">".clean_it($note['NoteText'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"note\" value=\"".$_REQUEST['note']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"note\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  } elseif ($_REQUEST['type'] == "quote"){
    incheader("Edit Quotes");
    $quote = mysql_fetch_array(mysql_query("SELECT QuoteText FROM kpfw_quotes WHERE QuoteID = '".$_REQUEST['quote']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<textarea rows=\"5\" cols=\"50\" name=\"quotetext\">".clean_it($quote['QuoteText'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"quote\" value=\"".$_REQUEST['quote']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"quote\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  } elseif ($_REQUEST['type'] == "goof"){
    incheader("Edit Goofs");
    $goof = mysql_fetch_array(mysql_query("SELECT GoofText FROM kpfw_goofs WHERE GoofID = '".$_REQUEST['goof']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<textarea rows=\"5\" cols=\"50\" name=\"gooftext\">".clean_it($goof['GoofText'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"goof\" value=\"".$_REQUEST['goof']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"goof\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  } elseif ($_REQUEST['type'] == "cultural"){
    incheader("Edit Cultural References");
    $cultural = mysql_fetch_array(mysql_query("SELECT CulturalText FROM kpfw_cultural WHERE CultID = '".$_REQUEST['cultural']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<textarea rows=\"5\" cols=\"50\" name=\"culturaltext\">".clean_it($cultural['CulturalText'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"cultural\" value=\"".$_REQUEST['cultural']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"cultural\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  } elseif ($_REQUEST['type'] == "dvdnote"){
    incheader("Edit DVD Notes");
    $dvdnote = mysql_fetch_array(mysql_query("SELECT NoteText FROM kpfw_dvdnotes WHERE DVDNoteID = '".$_REQUEST['noteid']."'"));
    echo "<br><form action=\"guide.php?mode=submit\" method=\"post\">\n";
    echo "<textarea rows=\"5\" cols=\"50\" name=\"notetext\">".clean_it($dvdnote['NoteText'])."</textarea><br>\n";
    echo "<input type=\"hidden\" name=\"noteid\" value=\"".$_REQUEST['noteid']."\">\n";
    echo "<input type=\"hidden\" name=\"type\" value=\"dvdnote\">\n";
    echo "<input type=\"submit\" value=\"Submit\"></form><br>";
    footer();
  }
} elseif ($_GET['mode'] == "submit"){
  if ($_REQUEST['type'] == "stars"){
    $stars = mysql_fetch_array(mysql_query("SELECT Stars FROM kpfw_epguide WHERE EpId = '".$_REQUEST['ep']."'"));
    $eptitle = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
    mail_admin("Ep Guide>".$eptitle['EpTitle'].">Stars",$stars['Stars'],clean_it($_REQUEST['stars']));
    $sql = mysql_query("UPDATE kpfw_epguide SET Stars = '".clean_it($_REQUEST['stars'])."' WHERE EpId = '".$_REQUEST['ep']."'");
    header("Location: guides/".$_REQUEST['ep']);
  } elseif ($_REQUEST['type'] == "guests"){
    $guests = mysql_fetch_array(mysql_query("SELECT GuestStars FROM kpfw_epguide WHERE EpId = '".$_REQUEST['ep']."'"));
    $eptitle = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$_REQUEST['ep']."'"));
    mail_admin("Ep Guide>".$eptitle['EpTitle'].">Guest Stars",$stars['GuestStars'],clean_it($_REQUEST['guests']));
    $sql = mysql_query("UPDATE kpfw_epguide SET GuestStars = '".clean_it($_REQUEST['guests'])."' WHERE EpId = '".$_REQUEST['ep']."'");
    header("Location: guides/".$_REQUEST['ep']);
  } elseif ($_REQUEST['type'] == "note"){
    $note = mysql_fetch_array(mysql_query("SELECT NoteText,EpId FROM kpfw_epnotes WHERE NoteId = '".$_REQUEST['note']."'"));
    $eptitle = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$note['EpId']."'"));
    mail_admin("Notes>".$eptitle['EpTitle'],$note['NoteText'],clean_it($_REQUEST['notetext']));
    $sql = mysql_query("UPDATE kpfw_epnotes SET NoteText = '".clean_it($_REQUEST['notetext'])."' WHERE NoteId = '".$_REQUEST['note']."'");
    header("Location: guides/".$note['EpId']);
  } elseif ($_REQUEST['type'] == "quote"){
    $quote = mysql_fetch_array(mysql_query("SELECT QuoteText,EpId FROM kpfw_quotes WHERE QuoteId = '".$_REQUEST['quote']."'"));
    $eptitle = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$quote['EpId']."'"));
    mail_admin("Quotes>".$eptitle['EpTitle'],$quote['QuoteText'],clean_it($_REQUEST['quotetext']));
    $sql = mysql_query("UPDATE kpfw_quotes SET QuoteText = '".clean_it($_REQUEST['quotetext'])."' WHERE QuoteId = '".$_REQUEST['quote']."'");
    header("Location: guides/".$quote['EpId']);
  } elseif ($_REQUEST['type'] == "goof"){
    $goof = mysql_fetch_array(mysql_query("SELECT GoofText,EpId FROM kpfw_goofs WHERE GoofID = '".$_REQUEST['goof']."'"));
    $eptitle = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$goof['EpId']."'"));
    mail_admin("Goofs>".$eptitle['EpTitle'],$goof['GoofText'],clean_it($_REQUEST['gooftext']));
    $sql = mysql_query("UPDATE kpfw_goofs SET GoofText = '".clean_it($_REQUEST['gooftext'])."' WHERE GoofID = '".$_REQUEST['goof']."'");
    header("Location: guides/".$goof['EpId']);
  } elseif ($_REQUEST['type'] == "cultural"){
    $cultural = mysql_fetch_array(mysql_query("SELECT CulturalText,EpId FROM kpfw_cultural WHERE CultId = '".$_REQUEST['cultural']."'"));
    $eptitle = mysql_fetch_array(mysql_query("SELECT EpTitle FROM kpfw_eplist WHERE EpId = '".$cultural['EpId']."'"));
    mail_admin("Cultural Reference>".$eptitle['EpTitle'],$cultural['CulturalText'],clean_it($_REQUEST['culturaltext']));
    $sql = mysql_query("UPDATE kpfw_cultural SET CulturalText = '".clean_it($_REQUEST['culturaltext'])."' WHERE CultId = '".$_REQUEST['cultural']."'");
    header("Location: guides/".$cultural['EpId']);
  } elseif ($_REQUEST['type'] == "dvdnote"){
    $dvdnote = mysql_fetch_array(mysql_query("SELECT NoteText,DVD_ID FROM kpfw_dvdnotes WHERE DVDNoteId = '".$_REQUEST['noteid']."'"));
    $title = mysql_fetch_array(mysql_query("SELECT Title FROM kpfw_dvdmovie WHERE Id = '".$dvdnote['DVD_ID']."'"));
    mail_admin("DVD/Movie Guide>".$title['Title'],$dvdnote['NoteText'],clean_it($_REQUEST['dvdnotetext']));
    $sql = mysql_query("UPDATE kpfw_dvdnotes SET NoteText = '".clean_it($_REQUEST['dvdnotetext'])."' WHERE DVDNoteId = '".$_REQUEST['noteid']."'");
    header("Location: movie/".$dvdnote['DVD_ID']);
  }
}
?>
