<?PHP
include("includes/functions.php");
incheader("Model Sheets");
$where = $_GET['what'];
$pic = $_GET['pic'];
print "<br><br><center><a href = \"modelsheets/$where\">Back</a><br><br><img border = \"0\" alt=\"$pic\" src = \"images/modelsheets/$where/$pic\"><br><br>";
print "</center>";
include ("includes/footer.inc");
?>