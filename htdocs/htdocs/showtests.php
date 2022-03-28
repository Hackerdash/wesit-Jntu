<?php
session_start();
?>
<html>
<head>
<title>Online Quiz - Test List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style2.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
extract($_GET);
error_reporting(E_ERROR || E_PARSE);
mysql_connect("localhost","root","");
mysql_select_db("jntuacep_oes");
$subid1=$_GET['subid'];

$rs1=mysql_query("select * from 'epic_subject' where sub_id like'$subid1'");
var_dump($rs1);
$row1=mysql_fetch_array($rs1);

echo "<h1 align=center><font color=blue> $row1[1]</font></h1>";
$rs=mysql_query("select * from epic_test where sub_id=$subid");
if(mysql_num_rows($rs)<1)
{
	echo "<br><br><h2 class=head1> No Quiz for this Subject </h2>";
	exit;
}
echo "<h2 class=head1> Select Quiz Name to Give Quiz </h2>";
echo "<table align=center>";

while($row=mysql_fetch_row($rs))
{
	echo "<tr><td align=center ><a href=quiz.php?testid=$row[0]&subid=$subid><font size=4>$row[2]</font></a>";
}
echo "</table>";
?>
</body>
</html>
