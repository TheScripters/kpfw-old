<?php
// Code © 2006 KPFanWorld.com
// Code written by Adam Humpherys
/*******donate.php***************/
include("includes/functions.php");
/* Include this before your html code */
include "season5/poll_cookie.php";
incheader("Vote for a 5th season of Kim Possible");
print "<br><br>";

/* path */
$poll_path = "/home/kpfanwor/public_html/season5";

require $poll_path."/include/config.inc.php";
require $poll_path."/include/$POLLDB[class]";
require $poll_path."/include/class_poll.php";
require $poll_path."/include/class_pollcomment.php";
require $poll_path."/include/class_plist.php";
$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect();

$php_poll = new plist();

/* poll */
$php_poll->set_template_set("plain");
$php_poll->set_max_bar_length(125);
$php_poll->set_max_bar_height(10);
if (isset($HTTP_GET_VARS['poll_id'])) {
   echo $php_poll->poll_process($HTTP_GET_VARS['poll_id']);
} else {
   echo $php_poll->poll_process("random");
}

/* poll list */
$php_poll->set_template("poll_list");
$php_poll->set_date_format("m/d/Y");
echo $php_poll->view_poll_list();
echo $php_poll->get_list_pages();
footer();
?>